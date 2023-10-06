import { Button, Col, Form, Input, List, Row, notification } from "antd";
import axios from "axios";
import React, { useState } from "react";

const Borrow = () => {
    const Context = React.createContext({
        name: 'Default',
      });
    const [api, contextHolder] = notification.useNotification();

    interface MemberData {
        id: Number,
        code: String,
        name: String,
    }      
    interface BookData {
        id: Number,
        code: String,
        title: String,
        author: String,
    }
    interface BookUnitData {
        id: Number,
        code: String,
        title: String,
        author: String,
    }
    interface FinalData {
        member_id: Number,
        book_unit_ids: Number[],
    }

    const [memberData, setMemberData] = useState<MemberData>({
        id: 0,
        code: '',
        name: '',
    });
    const [bookData, setBookData] = useState<BookData>();
    const [bookUnitData, setBookUnitData] = useState<BookUnitData[]>([]);
    const [finalData, setFinalData] = useState<FinalData>({
        member_id: 0,
        book_unit_ids: [],
    });

    const addMemberEnter = (e: any) => {
        if(e.key === "Enter"){
            addMember();
        }
    }
    const addMember = () => {
        if(memberId){
            axios
                .get(`/api/transaction/borrow/member/`, { params:{ id: memberId }})
                .then((response) => {
                    const data = response.data.data.member;
                    setMemberData({
                        id: data.id,
                        code: data.code,
                        name: data.name,
                    })
                })
                .catch((error) => {
                    if(error.response.status === 400){
                        openFailedNotification(error.response.data.message);
                    } else if(error.response.status === 422){
                        const errors = error.response.data.errors;
                        const firstKey = Object.keys(errors)[0];
                        openFailedNotification(`${firstKey} : ${errors[firstKey][0]}`);
                    } else if(error.response.status === 500){
                        openFailedNotification('Something went wrong');
                    }
                    setMemberData({
                        id: 0,
                        code: '',
                        name: '',
                    })
                })
                .finally(() => {
                    form.setFieldsValue({ member_id: '' });
                });
        }
    }
    const addBookUnitEnter = (e: any) => {
        if(e.key === "Enter"){
            addBookUnit();
        }
    }
    const addBookUnit = () => {
        if(bookUnitId){
            for(const check of bookUnitData){
                if(parseInt(bookUnitId) === check.id) return false;
            }
            axios
            .get(`/api/transaction/borrow/book/`, { params:{ id: bookUnitId }})
            .then((response) => {
                    const data = response.data.data.book_unit;
                    setBookUnitData([
                        ...bookUnitData,
                        {
                            id: data.id,
                            code: data.code,
                            title: data.book.title,
                            author: data.book.author,
                        }
                    ]);
                })
                .catch((error) => {
                    if(error.response.status === 400){
                        openFailedNotification(error.response.data.message);
                    } else if(error.response.status === 422){
                        const errors = error.response.data.errors;
                        const firstKey = Object.keys(errors)[0];
                        openFailedNotification(`${firstKey} : ${errors[firstKey][0]}`);
                    } else if(error.response.status === 500){
                        openFailedNotification('Something went wrong');
                    }
                })
                .finally(() => {
                    form.setFieldsValue({ book_unit_id: '' });
                });
        }
    }
    const deleteBookUnit = (index: number) => {
        let tmpBookUnitData = [...bookUnitData];
        tmpBookUnitData.splice(index, 1);
        setBookUnitData(tmpBookUnitData);
    }
    const submit = () => {
        let tmpFinalData = finalData;
        tmpFinalData.member_id = memberData.id;
        tmpFinalData.book_unit_ids = [];
        for(const check of bookUnitData){
            tmpFinalData.book_unit_ids.push(check.id);
        }
        setFinalData(tmpFinalData);
        axios
            .post(`/api/transaction/borrow/`, finalData)
            .then((_response) => {
                    openSuccessNotification('Success');
                    setMemberData({
                        id: 0,
                        code: '',
                        name: '',
                    });
                    setBookUnitData([]);
                })
                .catch((error) => {
                    if(error.response.status === 400){
                        openFailedNotification(error.response.data.message);
                    } else if(error.response.status === 422){
                        const errors = error.response.data.errors;
                        const firstKey = Object.keys(errors)[0];
                        openFailedNotification(`${firstKey} : ${errors[firstKey][0]}`);
                    } else if(error.response.status === 500){
                        openFailedNotification('Something went wrong');
                    }
                })
                .finally(() => {
                    form.setFieldsValue({ book_unit_id: '' });
                });
    }
    const openFailedNotification = (message: String) => {
        api.error({
            message: 'Failed',
            description: <Context.Consumer>{({ name }) => message}</Context.Consumer>,
            placement: 'topRight',
        });
    };
    const openSuccessNotification = (message: String) => {
        api.success({
            message: 'Success',
            description: <Context.Consumer>{({ name }) => message}</Context.Consumer>,
            placement: 'topRight',
        });
    };

    const [form] = Form.useForm();
    const memberId = Form.useWatch('member_id', form);
    const bookUnitId = Form.useWatch('book_unit_id', form);
    return (
        <div>
            {contextHolder}
            <Row>
                <Col span={12}>
                    <h1>Borrow</h1>
                </Col>
                <Col span={12} push={10}>
                    <Button type="primary" onClick={submit}>Save</Button>
                </Col>
            </Row>
            <Row gutter={40}>
                <Col span={14}>
                    <Form form={form} layout="vertical">
                        <Row gutter={8}>
                            <Col span={20}>
                                <Form.Item label="Member ID" name="member_id">
                                    <Input placeholder="Member Id" onKeyUp={addMemberEnter}/>
                                </Form.Item>
                            </Col>
                            <Col span={4}>
                                <Form.Item label=" ">
                                    <Button type="primary" onClick={addMember}>+</Button>
                                </Form.Item>
                            </Col>
                        </Row>
                        <Row gutter={8}>
                            <Col span={20}>
                                <Form.Item label="Book Unit Id" name="book_unit_id">
                                    <Input placeholder="Book Unit Id" onKeyUp={addBookUnitEnter}/>
                                </Form.Item>
                            </Col>
                            <Col span={4}>
                                <Form.Item label=" ">
                                    <Button type="primary" onClick={addBookUnit}>+</Button>
                                </Form.Item>
                            </Col>
                        </Row>
                    </Form>
                    <div
                        id="scrollableDiv"
                        style={{
                            height: 400,
                            overflow: 'auto',
                            padding: '0 16px',
                            border: '1px solid rgba(140, 140, 140, 0.35)',
                        }}
                        >
                            <List
                                itemLayout="horizontal"
                                dataSource={bookUnitData}
                                renderItem={(item, index) => (
                                    <List.Item
                                        actions={[<a key="list-loadmore-edit" onClick={() => deleteBookUnit(index)}>delete</a>]}
                                    >
                                        <List.Item.Meta
                                        title={'('+item.code+') '+item.title}
                                        description={item.author}
                                        />
                                    </List.Item>
                                )}
                            />
                        </div>
                </Col>
                <Col span={10}>
                    <Row><Col><h5>Member ID</h5></Col></Row>
                    <Row><Col>{memberData.id !== 0 ? memberData.id.toString() : ''}</Col></Row>
                    <Row><Col><h5>Member Code</h5></Col></Row>
                    <Row><Col>{memberData.code}</Col></Row>
                    <Row><Col><h5>Member Name</h5></Col></Row>
                    <Row><Col>{memberData.name}</Col></Row>
                </Col>
            </Row>
        </div>
    )
}

export default Borrow;