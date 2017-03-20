# Project 7 - WordPress Pentesting

Time spent: **15** hours spent in total

> Objective: Find, analyze, recreate, and document **five vulnerabilities** affecting an old version of WordPress

## Pentesting Report

1. (Required) WordPress <= 4.3 - Authenticated Shortcode Tags Cross-Site Scripting (XSS)
  - [x] Summary: Cross-site scripting (XSS) vulnerability in WordPress before 4.3.1 allows remote attackers to inject arbitrary web script or HTML by leveraging the mishandling of unclosed HTML elements during processing of shortcode tags.
    - Vulnerability types: Cross-Site Scripting (XSS)
    - Tested in version: 4.2.2
    - Fixed in version: 4.2.5
  - [x] GIF Walkthrough: <img src='http://i.imgur.com/XMDQ2cK.gif' />
  - [x] Steps to recreate - Place in the body of a new page or post: 
  ```
  TEST!!![caption width="1" caption='<a href="' ">]</a><a href="http://onMouseOver='alert(1)'">Click me</a>>
  ```
  - [x] Affected source code: wp-includes/shortcodes.php
    - [Link 1](https://wpvulndb.com/vulnerabilities/8186)
2. (Required) WordPress  4.0-4.7.2 - Authenticated Stored Cross-Site Scripting (XSS) in YouTube URL Embeds
  - [x] Summary: In WordPress before 4.7.3 (wp-includes/embed.php), there is authenticated Cross-Site Scripting (XSS) in YouTube URL Embeds.
    - Vulnerability types: Cross-Site Scripting (XSS)
    - Tested in version: 4.2.2
    - Fixed in version: 4.7.2
  - [x] GIF Walkthrough: <img src='http://i.imgur.com/6NXhmwc.gif' />
  - [x] Steps to recreate - Place in the body of a new page or post: [embed src='https://youtube.com/watch?v=abc<svg onload=alert(1)>'][/embed]
  - [x] Affected source code: wp-includes/embed.php
    - [Link 1](https://blog.sucuri.net/2017/03/stored-xss-in-wordpress-core.html)
3. (Required) WordPress 2.5-4.6 - Authenticated Stored Cross-Site Scripting via Image Filename
  - [x] Summary: Cross-site scripting (XSS) vulnerability in the media_handle_upload function in wp-admin/includes/media.php in WordPress before 4.6.1 might allow remote attackers to inject arbitrary web script or HTML by tricking an administrator into uploading an image file that has a crafted filename.
    - Vulnerability types: Cross-Site Scripting (XSS)
    - Tested in version: 4.2.2
    - Fixed in version: 4.4.5
  - [x] GIF Walkthrough: <img src='http://i.imgur.com/8dotowf.gif' />
  - [x] Steps to recreate - Create a new page or post with the following title: testing<img src=a onerror=alert("XSS")>.jpg
  - [x] Affected source code: wp-admin/includes/media.php
    - [Link 1](https://sumofpwn.nl/advisory/2016/persistent_cross_site_scripting_vulnerability_in_wordpress_due_to_unsafe_processing_of_file_names.html) 

## Assets

List any additional assets, such as scripts or files

## Resources

- [WordPress Source Browser](https://core.trac.wordpress.org/browser/)
- [WordPress Developer Reference](https://developer.wordpress.org/reference/)

GIFs created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while doing the work

Finding examples of how to exploit certain vulnerabilities were difficult.

## License

    Copyright [2017] [William Gao]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
