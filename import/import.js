const csv = require('csv-parser');
const fs = require('fs');

const mysql = require('mysql');
const connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'company'
});

connection.connect();

const data = [];

fs.createReadStream('database.csv')
  .pipe(csv())
  .on('data', (row) => {
    delete row[''];
    data.push(row);
  })
  .on('end', () => {
    let sql = "INSERT INTO `company` (`id`, `name`, `city_name`, `geometry_name`, `post_code`, `phone`, `email`, `website`, `vkontakte`, `instagram`, `lon`, `lat`, `category`, `subcategory`) VALUES ?";
    let values = [];

    data.forEach(elem => {
      values.push([elem['id'], elem['name'], elem['city_name'], elem['geometry_name'], elem['post_code'] ? elem['post_code'] : null, elem['phone'], elem['email'],  elem['website'], elem['vkontakte'], elem['instagram'], elem['lon'] ? elem['lon'] : null, elem['lat'] ? elem['lat'] : null, elem['category'], elem['subcategory'] ? elem['subcategory'] : null]);
    });

    const result = connection.query(sql, [values], function (error) {
      if (error) throw console.log(error.message);
      console.log('Good!');

      connection.close();
    });

    console.log(result.sql)
  }); 