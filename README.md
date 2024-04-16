<p align="center"><a href="https://www.local-brand-x.com/" target="_blank">
    LOCAL BRAND X
</a>
</p>

</p>

## Minimal system requirements

- PHP >= 8.0
- MySQL
- Laravel


## How to run the application
Below are the steps you need to successfully setup and run the application.

- Clone the app from the repository and cd into the root directory of the app

- Run composer install
- Copy .env.example into .env
- Update DB credentials to match with your db
- Run `php artisan migrate`
- Run `php artisan serve`


## Assestment Information

Create an employee batch import + management REST API
-----------------------------------------------------

  

### Create the entity:

Employees should be represented by a data model with proper data types containing these fields taken from the `import.csv` :

[import.csv](https://t36654621.p.clickup-attachments.com/t36654621/cc240282-787a-4c10-9ee5-93e9f65f4128/import.csv)

  

*   Employee ID (unique Identifier)
*   User Name
*   Name Prefix
*   First Name
*   Middle Initial
*   Last Name
*   Gender
*   E-Mail
*   Date of Birth
*   Time of Birth
*   Age in Yrs.
*   Date of Joining
*   Age in Company (Years)
*   Phone No.
*   Place Name
*   County
*   City
*   Zip
*   Region

  

### Batch processing API:

  

Create an endpoint `POST /api/employee` accepting CSV files. Keep in mind those files can be huge and must work reliably. The provided `import.csv` provided must be processible with your api.

  

[import.csv](https://t36654621.p.clickup-attachments.com/t36654621/cc240282-787a-4c10-9ee5-93e9f65f4128/import.csv)

  

This endpoint should be able to handle the following example request with the csv file provided.

  

`curl -X POST -H 'Content-Type: text/csv' --data-binary @import.csv http://{yourapp}/api/employee`

### REST API's

  

Realize classic RESTful API's for employee management:

*   `GET /api/employee`
*   `GET /api/employee/{id}`
*   `DELETE /api/employee/{id}`

  

Output should be `JSON`
