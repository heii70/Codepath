# Project 10 - Fortress Globitek

Time spent: **15** hours spent in total

> Objective: Create an intentionally vulnerable version of the Globitek application with a secret that can be stolen.

### Requirements

- [x] All source code and assets necessary for running app
- [x] `/globitek.sql` containing all required SQL, including the `secrets` table
- [x] GIF Walkthrough of compromise
- [x] Brief writeup about the vulnerabilities introduced below

### Vulnerabilities

Describe the vuln(s) here.

There are two major vulnerabilities which allows this exploit to work. The first most obvious vulnerability is that the database is secured with a weak password; this makes it very easy to crack using brute force. The second vulnerability is that the database allows any host computer to access and login to it using one of the user's credentials. Weak passwords and open host access makes accessing the database very convenient for legitimate users but also makes it very easy to infiltrate for hackers.

The host IP address is first attacked with nmap to scan for open ports; a MySQL database on port 3306 is detected. Metasploit is then used to search for MySQL vulnerabilities; the login vulnerability is used. The target host, port, username, and password list is configured and the exploit is executed. The password associated with the username is found, which is then used to login to the database.

Host Logon Permissions Table:

<img src="http://i.imgur.com/OXameKL.jpg">

GIF Walkthrough:

<img src="http://i.imgur.com/2LvIxG6.gif">