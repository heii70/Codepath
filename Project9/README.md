# Project 10 - Honeypot

Time spent: **20** hours spent in total

> Objective: Setup a honeypot and provide a working demonstration of its features.

### Required: Overview & Setup

- [x] A basic writeup (250-500 words) on the `README.md` describing the overall approach, resources/tools used, findings
- [x] A specific, reproducible honeypot setup, ideally automated. There are several possibilities for this:
	- A Vagrantfile or Dockerfile which provisions the honeypot as a VM or container
	- A bash script that installs and configures the honeypot for a specific OS
	- Alternatively, **detailed** notes added to the `README.md` regarding the setup, requirements, features, etc.

### Required: Demonstration

- [x] A basic writeup of the attack (what offensive tools were used, what specifically was detected by the honeypot)
- [ ] An example of the data captured by the honeypot (example: IDS logs including IP, request paths, alerts triggered)
- [ ] A screen-cap of the attack being conducted
    
Overview Summary:

This demonstration utilizes Vagrant and the tools provided by the Modern Honey Network to set up a honeypot that detects attacks and records attackers' credentials and attempted exploits. MHN comes packaged with various intrusion detection software such as Snort, Kippo, Conpot, and Dionaea which consist of sensors, logs, and other tools. It also includes a server for centralized management. Vagrant is used to create virtual machines contained in Vagrant boxes to run this software. In this demonstration, two VMs are used: the admin console server for managing honeypots and the honeypot server that will be used as the target. A third VM can be created to play the role of attacker but this isn't necessary since the admin server can be used to play a double agent role. The services of Dionaea are used to set up a honeypot that detects packet sniffing, port scanning, and other types of intrusions. The admin server provides deployment commands and script to set up the honeypot.

Attack Summary:

In this demonstration, the target is atatacked with nmap which will attempt to obtain port, host, and service information. Instead of outputing information, the terminal stalls from the endpoint of the attacker. The honeypot records the attacker's information and attempted targets, which can be view from the admin server logs. Specifically, the honeypot recorded the attackers' IP address, attempted target ports, time, and attack protocal. 