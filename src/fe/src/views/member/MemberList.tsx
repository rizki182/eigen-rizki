import { Table } from "antd";
import { useEffect, useState } from "react";
import axios from 'axios';

const MemberList = () => {
    interface MemberData {
        id: Number,
        code: String,
        name: String,
        penalized_until: String,
        borrowed_count: Number,
    }
    const [memberData, setMemberData] = useState<MemberData[]>([]);
    const memberDataColumn = [
        {
          title: 'Id',
          dataIndex: 'id',
          key: 'id',
        },
        {
          title: 'Code Code',
          dataIndex: 'code',
          key: 'codee',
        },
        {
          title: 'Name',
          dataIndex: 'name',
          key: 'name',
        },
        {
          title: 'Penalized Until',
          dataIndex: 'penalized_until',
          key: 'penalized_until',
        },
        {
          title: 'Borrowed Count',
          dataIndex: 'borrowed_count',
          key: 'borrowed_count',
        },
      ];
      
      

    const getMemberData = () => {
        axios
            .get('/api/member')
            .then((response) => {
                let tmpMemberData = [...memberData];
                const data = response.data.data.member;
                for(const data of response.data.data.member) {
                    tmpMemberData.push({
                        id: data.id,
                        code: data.code,
                        name: data.name,
                        penalized_until: (data.penalized_until) ? data.penalized_until : '-',
                        borrowed_count: data.book_units.length,
                    })
                }
                setMemberData(tmpMemberData);
            })
            .catch((error) => {
                console.log(error.response.status);
            })
            .finally(() => {
                console.log('finish');
            })
    }

    useEffect(() => {
        getMemberData();
    }, [])
    return (
        <div>
            <h1>Member</h1>
            <Table columns={memberDataColumn} dataSource={memberData} />
        </div>
    )
}

export default MemberList;