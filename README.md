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

---

### 5. 后台脚本

Method: PHP脚本

##### 初始化场次信息:

```
  php script/createQuality.php
```

##### 推送模版消息:

```
   php script/pushTmpMsg.php 2017-04-26
```
