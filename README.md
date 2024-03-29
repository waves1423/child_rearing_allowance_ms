# Child Rearing Allowance Management System
![jifu-ms-logo](https://user-images.githubusercontent.com/101188604/184539984-0cfaaa1b-2b2b-486c-a736-f72c357ac96c.png)  
You can manage information on recipients of child rearing allowance(児童扶養手当) and special child rearing allowance(特別児童扶養手当).  

# Description
Allowance recipients, their spouses, and support obligors(people who share livelihoods with recipients and are able to take care of children) can be registered, and income calculations can be performed.  
***This system is compatible with 100,000 yen income deduction in accordance with tax law revisions applicable from October 2021 onward.***  

# URL
~~https://child-allowance.com~~  
URL is currently unavailable.

# Demonstration
![demo_2x](https://user-images.githubusercontent.com/101188604/198323232-709a573f-486a-4673-aa16-4443f6ed7942.gif)

# Features
- Multi-login
    - Administrator(create, edit and delete) and user(create and edit)
- Recipients Registration
    - Recipient, its spouse and support obligor(highest earning cohabiting relative)
- Search recipient
    - Multiple keyword search for kana and kanji
    - Type of receiving allowance can be identified by icons
- Income calculation
    - Based on types of income and deductions entered, income after deductions is automatically calculated.
- CSV download

# Requirements
## Front-end
- HTML/CSS
- JavaScript
- TailwindCSS 3.1.0
- Node.js 16.16.0

## Back-end
- PHP 8.1.8
- Laravel 9.24.0
- MySQL 8.0.29
- Composer 2.3.10

## Infrastracture
- Production: AWS (EC2, ALB, RDS, CloudFront, ACM, Route53, VPC, IAM)
- Developement: Laravel Sail 8.1

# Architecture
## ERD
![er](https://user-images.githubusercontent.com/101188604/191507123-e7cd969e-827f-41d0-97ac-570bbd46b8af.png)
## AWS
![aws](https://user-images.githubusercontent.com/101188604/188660011-a446ed8e-b77e-43d6-b9f9-8e7a292625fa.png)

# License
The source code is under the MIT license.

# References
For more infomation on these allowances, see Ministry of Health, Labor and Welfare website.  
[Child rearing allowance](https://www.mhlw.go.jp/bunya/kodomo/osirase/100526-1.html)  
[Special child rearing allowance](https://www.mhlw.go.jp/bunya/shougaihoken/jidou/huyou.html) 