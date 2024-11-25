#!/bin/bash

# MySQL credentials
DB_USER="root"
DB_PASS="Mysql@2024"

mysql -u $DB_USER -p$DB_PASS < create_cbk.sql

if [ $? -eq 0 ]; then
    echo "Database and table created successfully!"
else
    echo "Failed to create database or table. Please check your credentials and SQL file."
fi