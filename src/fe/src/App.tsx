import { Content, Header } from 'antd/es/layout/layout';
import './App.css';
import { Layout, Menu } from 'antd';
import Sider from 'antd/es/layout/Sider';
import { HashRouter, Link, Route, Routes } from 'react-router-dom'
import React, { Suspense } from 'react';

const BookList = React.lazy(() =>  import('./views/book/BookList'));
const BookUnitList = React.lazy(() =>  import('./views/book_unit/BookUnitList'));
const MemberList = React.lazy(() =>  import('./views/member/MemberList'));
const Borrow = React.lazy(() =>  import('./views/transaction/Borrow'));
const Return = React.lazy(() =>  import('./views/transaction/Return'));

function App() {
  const items1 = [
      {
          key: '/book/list',
          label: <Link to='/book/list'>Book</Link>,
      },
      {
          key: '/book-unit/list',
          label: <Link to='/book-unit/list'>Book Unit</Link>,
      },
      {
          key: '/member/list',
          label: <Link to='/member/list'>Member</Link>,
      },
      {
          key: '/borrow',
          label: <Link to='/transaction/borrow'>Borrow</Link>,
      },
      {
          key: '/return',
          label: <Link to='/transaction/return'>Return</Link>,
      },
  ];

  return (
    <HashRouter>
      <Suspense>
      <Layout>
        <Header
          style={{
            display: 'flex',
            alignItems: 'center',
            background: '#108ee9',
          }}
        >
          <div className="demo-logo" />
        </Header>
        <Layout>
          <Sider
            width={200}
            style={{
              background: "#ffffff",
            }}
          >
            <Menu
              mode="inline"
              defaultSelectedKeys={['1']}
              defaultOpenKeys={['sub1']}
              style={{
                height: '100%',
                borderRight: 0,
              }}
              items={items1}
            />
          </Sider>
          <Layout
            style={{
              padding: '0 24px 24px',
            }}
          >
            <Content
              style={{
                padding: 24,
                marginTop: 20,
                minHeight: '80vh',
                background: "#ffffff",
              }}
            >
                <Routes>
                  <Route path="/" element={<BookList />} />
                  <Route path="/book/list" element={<BookList />} />
                  <Route path="/book-unit/list" element={<BookUnitList />} />
                  <Route path="/member/list" element={<MemberList />} />
                  <Route path="/transaction/borrow" element={<Borrow />} />
                  <Route path="/transaction/return" element={<Return />} />
                </Routes>
            </Content>
          </Layout>
        </Layout>
      </Layout>
      </Suspense>
    </HashRouter>

  );
}

export default App;
