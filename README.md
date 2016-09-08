# NETsocLeaderboard
A leaderboarding system intended for UOIT's NETsoc.

# SQL Schema
## For Users
```SQL
	CREATE TABLE IF NOT EXISTS users(
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		username VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		sessionToken VARCHAR(255) NOT NULL,
		sessionExpiration DATETIME NOT NULL,
		email VARCHAR(255) NOT NULL,
		name VARCHAR(255) NOT NULL,
		points INT DEFAULT 0 NOT NULL,
		picture VARCHAR(255),
		PRIMARY KEY (id)
	)
```
## Example
id|username|password|sessionToken|sessionExpiration|email|name|points|picture|
---|---|---|---|---|---|---|---|---
69|memer123xxx|salt+hash|16B random|2016-01-29 17:54:52|memer@uoit.net|john smith|6969  |https://i.imgur...
|70|dankboi420|salt+hash|16B random|2016-03-16 14:45:33|dankb@uoit.net|dave smith|69420 |https://i.imgur...
## For Answered Questions
```SQL
CREATE TABLE IF NOT EXISTS answered(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	question INT UNSIGNED NOT NULL,
	username VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
)
```
## Example
id|question|username
---|---|---
420|23|memer123xxx
421|24|memer123xxx
422|23|dankboi420
423|27|dankboi420
## For Questions
```SQL
CREATE TABLE IF NOT EXISTS questions(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	value INT NOT NULL,
	PRIMARY KEY (id)
)
```
id|value
---|---
420|1600
421|200
422|3000
423|400
