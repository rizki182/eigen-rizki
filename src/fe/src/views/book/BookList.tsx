import { Table } from "antd";
import { useEffect, useState } from "react";
import axios from 'axios';

const BookList = () => {
    interface BookData {
        id: Number,
        code: String,
        title: String,
        author: String,
        stock: Number,
    }
    const [bookData, setBookData] = useState<BookData[]>([]);
    const bookDataColumn = [
        {
          title: 'Id',
          dataIndex: 'id',
          key: 'id',
        },
        {
          title: 'Code',
          dataIndex: 'code',
          key: 'code',
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
          title: 'Stock',
          dataIndex: 'stock',
          key: 'stock',
        },
      ];
      
      

    const getBookData = () => {
        axios
            .get('/api/book')
            .then((response) => {
                let tmpBookData = [...bookData];
                const data = response.data.data.book;
                for(const data of response.data.data.book) {
                    tmpBookData.push({
                        id: data.id,
                        code: data.code,
                        title: data.title,
                        author: data.author,
                        stock: data.stock,
                    })
                }
                setBookData(tmpBookData);
            })
            .catch((error) => {
                console.log(error.response.status);
            })
            .finally(() => {
                console.log('finish');
            })
    }

    useEffect(() => {
        getBookData();
    }, [])
    return (
        <div>
            <h1>Book</h1>
            <Table columns={bookDataColumn} dataSource={bookData} />
        </div>
    )
}

export default BookList;