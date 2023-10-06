import { Table } from "antd";
import { useEffect, useState } from "react";
import axios from 'axios';

const BookUnitList = () => {
    interface BookUnitData {
        id: Number,
        unit_code: String,
        title: String,
        author: String,
        status: String,
        borrowed_by: String,
    }
    const [bookUnitData, setBookUnitData] = useState<BookUnitData[]>([]);
    const bookUnitDataColumn = [
        {
          title: 'Id',
          dataIndex: 'id',
          key: 'id',
        },
        {
          title: 'Unit Code',
          dataIndex: 'unit_code',
          key: 'unit_code',
        },
        {
          title: 'Title',
          dataIndex: 'title',
          key: 'title',
        },
        {
          title: 'Author',
          dataIndex: 'author',
          key: 'author',
        },
        {
          title: 'Status',
          dataIndex: 'status',
          key: 'status',
        },
        {
          title: 'Borrowed By',
          dataIndex: 'borrowed_by',
          key: 'borrowed_by',
        },
      ];
      
      

    const getBookUnitData = () => {
        axios
            .get('/api/book/unit')
            .then((response) => {
                let tmpBookUnitData = [...bookUnitData];
                const data = response.data.data.book_unit;
                for(const data of response.data.data.book_unit) {
                    tmpBookUnitData.push({
                        id: data.id,
                        unit_code: data.code,
                        title: data.book.title,
                        author: data.book.author,
                        status: data.status,
                        borrowed_by: data.member ? data.member.name : '-',
                    })
                }
                setBookUnitData(tmpBookUnitData);
            })
            .catch((error) => {
                console.log(error.response.status);
            })
            .finally(() => {
                console.log('finish');
            })
    }

    useEffect(() => {
        getBookUnitData();
    }, [])
    return (
        <div>
            <h1>BookUnit</h1>
            <Table columns={bookUnitDataColumn} dataSource={bookUnitData} />
        </div>
    )
}

export default BookUnitList;