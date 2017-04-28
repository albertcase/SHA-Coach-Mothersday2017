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
  msg: '预约成功！'
}
```

##### status 1005

```javascript
{
  status: '1005',
  msg: '名额已满！'
}
```

##### status 1006

```javascript
{
  status: '1006',
  msg: '您已预约！'
}
```

##### status 1007

```javascript
{
  status: '1007',
  msg: '预约失败！'
}
```

##### status 1008

```javascript
{
  status: '1008',
  msg: '预约失败！'
}
```

---

### 2. 上传作品API

Method: POST

##### API URL:

```html
  http://2017mothersday.samesamechina.com/api/uploadpic
```
##### Get Parameter

pic: base64图片流

```javascript
{
  pic: base64图片流
}
```

##### Response

##### status 1

```javascript
{
  status: '1',
  msg: pid
}
``` 

##### status 2002

```javascript
{
  status: '2002',
  msg: '您已创建过作品！'
}
``` 

##### status 2003

```javascript
{
  status: '2003',
  msg: '作品创建失败！'
}
``` 

##### status 2004

```javascript
{
  status: '2004',
  msg: '作品创建失败！'
}
``` 

---

### 3. 获取场次API

Method: POST

##### API URL:

```html
  http://2017mothersday.samesamechina.com/api/applylist
```

##### Response

##### status 1

```json
{ 
    "shop1":
    {
        "20170501":
        {
            "am":"10",
            "pm":"10"
        },
        "20170502":
        {
            "am":0,
            "pm":"10"
        }
    },
    "shop2":
    {
        "20170501":
        {
            "am":"8",
            "pm":"10"
        },
        "20170502":
        {
            "am":"9",
            "pm":"10"
        }
    }
}
``` 

---

### 4. 点赞API

Method: POST

##### API URL:

```html
  http://2017mothersday.samesamechina.com/api/praise
```
##### Get Parameter

pid: 作品id

```javascript
{
  pid: 1
}
```

##### Response

##### status 1

```javascript
{
  status: '1',
  msg: '点赞成功！'
}
``` 

##### status 2005

```javascript
{
  status: '2005',
  msg: '您已点赞！'
}
``` 

##### status 2008

```javascript
{
  status: '2008',
  msg: '点赞失败！'
}
``` 

##### status 2009

```javascript
{
  status: '2009',
  msg: '点赞失败！'
}
``` 

---

### 5. 后台脚本

Method: PHP脚本

##### 5.1初始化场次信息:

```
  php script/createQuality.php
```

##### 5.2推送模版消息:

```
   php script/pushTmpMsg.php 2017-04-26
```

##### 5.3更改场次名额数量:

```
   php script/updateQuality.php shop1:20170501:am 10
```

---

### 6. 其他
 
##### 6.1前端分享url:

```
  http://coach.samesamechina.com/api/v1/js/918fce91-ab24-42cd-9ca1-e7a86bd59fc0/wechat
```

