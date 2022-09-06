# Child Rearing Allowance Management System
![jifu-ms-logo](https://user-images.githubusercontent.com/101188604/184539984-0cfaaa1b-2b2b-486c-a736-f72c357ac96c.png)  
You can manage information on recipients of child rearing allowance(児童扶養手当) and special child rearing allowance(特別児童扶養手当).  

# Description
Allowance recipients, their spouses, and support obligors can be registered, and income calculations can be performed.  
***This system is compatible with 100,000 yen income deduction in accordance with tax law revisions applicable from October 2021 onward.***  

# URL
https://child-allowance.com

# Demonstration
Demo is here.

# Features
- Multi-login
    - Administrator and user
- Registration
    - Recipient, its spouse and support obligor
- Search recipient
    - Multiple keyword search for kana and kanji
    - Type of receiving allowance can be identified by icons
- Income calculation
    - Deductions based on type of income

# Requirements
## Front-end
- HTML/CSS
- JavaScript
- TailwindCSS 3.1.0
- Alpine.js 3.4.2

## Back-end
- PHP 8.1.8
- Laravel 9.24.0
- MySQL 8.0.29
- Composer 2.3.10

## Infrastracture
- AWS (EC2, ALB, ACM, RDS, Route53, VPC, EIP, IAM)
- Laravel Sail 8.1

# Architecture
## ERD
![er](https://user-images.githubusercontent.com/101188604/184528045-b97b0ea5-8d81-465d-991d-13a44ad664d4.png)
## AWS

# License
The source code is under the MIT license.

# References
For more infomation on these allowances, see Ministry of Health, Labor and Welfare website.  
[Child rearing allowance](https://www.mhlw.go.jp/bunya/kodomo/osirase/100526-1.html)  
[Special child rearing allowance](https://www.mhlw.go.jp/bunya/shougaihoken/jidou/huyou.html) 