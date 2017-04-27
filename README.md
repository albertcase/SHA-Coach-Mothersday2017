# SHA-Coach-Monthersday2017`s API

### 1. 线下预约API

Method: POST

##### API URL:

```html
  http://2017mothersday.samesamechina.com/api/apply
```
##### Get Parameter

name: 张三, tel: 13112345678, shop:shop1, date: 20170501:am

```javascript
{
  name: '张三',
  tel: '1312345678',
  shop: 'shop1',
  date: '20170501:am'
}
```

##### Response

##### status 1

```javascript
{
  status: '1',
  msg: 'apply success'
}
```