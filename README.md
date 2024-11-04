# HW8_SQL_Databases

To run the project, run the command ```docker-compose up -d```

1) The next step is to run ``docker-compose run app php artisan migrate``
2) To create 40 million users run ``docker-compose run app php artisan accounts:generate``
3) To test a sample from the database, execute the command with an additional parameter that can be changed ```docker-compose run app php artisan artisan compare:performance 1990-01-01```

Results of testing the sample time with and without indexes:
```
Time without index: 0.101734 seconds
Time with BTREE index: 0.002650 seconds
Time with HASH index: 0.002074 seconds
```

The execution time of filling the table with parameters:
1) ```--innodb_flush_log_at_trx_commit=2``` 58 minutes
2) ```--innodb_flush_log_at_trx_commit=2``` 42 minutes

Translated with DeepL.com (free version)