<h1 align="center">LopezPaul Blog</h1> 
<div align="center">
  <p>Blog module for Adobe Commerce.</p>
  <img src="https://img.shields.io/badge/magento-2.4.4+-brightgreen.svg?logo=magento&longCache=true&style=flat-square" 
    alt="Supported Magento Versions" />
  <a href="https://github.com/lopezpaul/magento2-modules" target="_blank">
    <img src="https://img.shields.io/badge/maintained%3F-yes-brightgreen.svg?style=flat-square" 
    alt="Maintained - Yes" /></a>
  <a href="https://opensource.org/licenses/MIT" target="_blank">
    <img src="https://img.shields.io/badge/license-MIT-blue.svg" />
    </a>
</div>

## Table of contents

- [Summary](#summary)
- [Installation](#installation)
- [Usage](#usage)
- [Dependencies](#dependencies)
- [GraphQL](#graphql)

---
## Summary

---

Create Admin Grid for manage Post table "lopezpaul_blog_post" with columns:

- id
- title
- content
- is_draft
- created_at
- updated_at
- publish_at


## Installation

---
```
composer require lopezpaul/magento2-blog
bin/magento module:enable Lopezpaul_Blog
bin/magento setup:upgrade
```


## Usage

---
Enter to admin panel and login and go to `Content > LopezPaul > Blog`
![Menu](Assets/menu-blog.png)

See list of post
![Index](Assets/grid-index.png)

Create or edit post
![Create](Assets/create-edit-post.png)

Search post
![Search](Assets/search.png)
You can use any filter and apply them to search Posts.

Permissions
![Roles](Assets/roles.png)
Create User roles with the right permissions.


## Dependencies

---

- Magento_Backend
- Magento_Ui


## Permissions

---
You can create new Role to set the right permissions

## GraphQL

---
![GraphQL](Assets/GraphQL.png)
Go to your magento `<domain_url>/graphql`
```
query{
  posts{
    id
    title
    content
    is_draft
    created_at
    updated_at
    publish_at
  }
}
```
