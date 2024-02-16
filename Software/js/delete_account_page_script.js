const express = require('express')
const bodyParser = require('body-parser')
const mysql = require('mysql')
const addDrug = document.querySelector(".add-box");

//mySQL user log in
const pool = mysql.createPool({
    host:'localhost',
    user:'root',
    password:'password',
    database:'B13_database'
})
