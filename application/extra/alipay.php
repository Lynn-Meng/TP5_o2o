<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/10/31
 * Time: 上午8:49
 */
return [
    //应用对应的appId
    'app_id' =>   '2016090800466828',
    //公钥
    'alipay_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAr18H3Z+cIm3Zkf4RG7LPy0w8WWRRex43BVorKSq6r/KNazpSRO+17CwK2VwJXW6qwepa57nLNo3VtSaMJjGS1z08hCT3+Hi9OOyrhRRyPs0N2NU8ms8yeZ7qUvwJtQ9FiJalkr+qBdmWjfTbOTKqU2IO/CLB9leukD3aK9NxvB4ffbz/7shZsDAw9vFiVwV4ovcWAeXS4DL1E4cfC5R71/cyqMD2FkLX2SKG/jDhySbEF50v3sCxlR3u6dDAb14q+L8wB8feP+kTravCuU1JHOvedWHl0FT8S/4ENBKgYObm8DRjYFsUE2L3osKPBb7Hkq4nUKs3wgecJp9ccoUlRwIDAQAB',
    //字符集
    'charset' => 'UTF-8',
    //加密类型
    'sign_type' => 'RSA2',
    //网关地址
    'gatewayUrl' => 'https://openapi.alipaydev.com/gateway.do',
    //私钥
    'merchant_private_key' => 'MIIEogIBAAKCAQEAr18H3Z+cIm3Zkf4RG7LPy0w8WWRRex43BVorKSq6r/KNazpSRO+17CwK2VwJXW6qwepa57nLNo3VtSaMJjGS1z08hCT3+Hi9OOyrhRRyPs0N2NU8ms8yeZ7qUvwJtQ9FiJalkr+qBdmWjfTbOTKqU2IO/CLB9leukD3aK9NxvB4ffbz/7shZsDAw9vFiVwV4ovcWAeXS4DL1E4cfC5R71/cyqMD2FkLX2SKG/jDhySbEF50v3sCxlR3u6dDAb14q+L8wB8feP+kTravCuU1JHOvedWHl0FT8S/4ENBKgYObm8DRjYFsUE2L3osKPBb7Hkq4nUKs3wgecJp9ccoUlRwIDAQABAoIBAF4mNqLUvY3+S4AFVkn4hXYvR3b2VIg0gHVvIxzGw9MR9LpMZT59Mr3IJ0rqDl0KvMG+f29IX8C6BLFsMHGQy7SiO4r2DepnZ67X4H1hrLPqgjSWxiKWehKxLju+87cwq7PYrKtMGotpdVpgyhC7EpYRXtoeDuOhzyXBDw/YRIcpAVyKSw9wYCoATjexMrOgIT8G5w1h7d3yOzwD3Sb2QhlUT9iJAJfBM63iQrDRQbRoIreJVL7f4TaATHfhpOCiebz5xtUsmFktFr+qkoyJvN6TCAX+//5KxuGSfCcK/4iw4wQjhL80GnEU/Br7UKv4FrOkHFiHkEGi+uzVNZFhXIECgYEA1Ps756M9NWCVus6d90klThj2vMFB4b8g8jWqNQN8SllALAsq6y5AqA+sRv71Fg9NLJLdEuqqU4FIA0/6e9KjFt9M+gsCt8nBj2X23hHtwGCy05unNZXscTeT0DQbG9l2xAQNgKq+/ev+LxVZ9sWrP/Ogdw6MF4n1BV5PJ8n5ILMCgYEA0ssQO2HP8mi+9OCAR4MWJeN3Zgby6Cp/13S+z+AjiUasBBPNCo0wyVjYCSR1SYfzu9fIwUYgnIv3bTq9B3oZ/7sBuYu0Z38UMS6q3YAq9jkFp5kRJG58EEluwopzVkjrVhvzmP94Rsc833yXMWbHfYYtljSWvPcWsEdwb4RoSx0CgYBASmJn5u/IGBK6pDos9miLbZ+1lMTVZ0ODuc1aWWYAb3aelPRsr7aWxLxlZfsHoLDUHrUbS7kEogbh8ReUnx3Z/qgW5pH4dq+2ILpniJPzOX1hwR+1Xj9UYcl91OzF+FwQiYSl7WTf84f0IIbapgqusFUk+0AwrtVGvJQ6V46bXwKBgDmxTDsEdVaiZok9HL712Mz76cTp5/e1EhJVKJhafz9mMVRYWwklRZIGF/LAoL1EUWg7Ef4cBHb0M/8YUX5HY/BDLaCr5O9ir5Mac7d2CcwkJTEOystO1fPbNU5XeGPIR2jk85IPccrlYvrD7dmeiMEJRVbUA+GqOvJ6SwKqmaTdAoGAHviCGXuyiNuAK/l7++ANK8WnrnEOJSkdYmGuU4r0eC8EdhHv4zVwFRMRGhyis6Dngv9cC1ZC2aBrOgaHj4nBeukTLapLSB17aR9RrG9S0ho9gYT+/9fBv8o7GVI7z5df38wUBbCzxbMW2FJ4QE3M4hQjKIqBYDZTcqNJXtvkJBg=',
    //服务器回调地址
    'notify_url' => 'http://o2o.local/index/notify/index',
    //前端跳转地址  不能带任何参数
    'return_url' => 'http://o2o.local/index/order/finish',
];