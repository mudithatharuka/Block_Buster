
# Block Buster

Block Buster is a Movies and TV Series review website that can be used to display details about newly arrived movies and TV series for big fans. This website was built using HTML, CSS, and PHP. Using a pre-designed user interface, the interface and the functions were built with simple coding patterns so that every developer who is at the beginning level can also be understood.

A separate admin panel was designed and developed so that the admins can add new movies and TV series to this website as they arrive or are in the theater already. 

Not only reviews, but users can also find movie trailers, videos, other media, and pieces of information such as the genre, stars, ratings, and many more using this website.

## Demo

Insert gif or link to demo

https://drive.google.com/file/d/1Ftw4PZJ-8leuNCt5I5hSqZW2PA4CKK-4/view?usp=share_link

![App Screenshot](https://1.bp.blogspot.com/-q3trwPYMTNI/Y3o9Ei9O-iI/AAAAAAAAAb8/1gyXgfWTl6k1zJ-GnTkngJZ8S-n24lTkgCNcBGAsYHQ/s320/clipped.mp4)
## Features

- List of newly arrived and upcomming Movies and Tv Series
![App Screenshot](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjZsQfPyhf32GYJVjaLGm70QtpUCnq6lM-sdYwdm3fJT3oe6Hh_jGp_lvgkefA0Z2MIlSAfQA61Sw-qFpB0PYbGUJLJ21tgC9y4CGxAE3zdYVT1JJzlqukC6VVOWZ3G2S3JhkVwtD-KjQMdsLYFdTdyiJM0DBZ1X5OteH_R-JByC6zkfpIEE3KMG83qiQ/s16000/Screenshot_46.png)

- A Full review about any film or TV Series
![App Screenshot](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjQwGsW6K_BE-RuIVlRijftKRgMz1iCGYDVyMKRw8Ra1s5OUxeCSu_a90KkfOq_iYSkLZ2gtdUlGbQ_ZYUk_WpWIroXhvyguhZZNRBuOcfertx8rrMi868xvqIRasrEEcVhQaDc-dUun5Kdvqt4CHdS2Oyp_1HAK1GG6dCrKlav9u60e-O2G7NEhVAKdg/s16000/Screenshot_47.png)

- Trilers of newly arrived movies
![App Screenshot](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEikhUu8T8bS1CTwBwc43xQ7YWtu6jB8kWLqyfYGEcjpk_DnPTPC5irhMW9CrOgeenv99tBIyzvtsO9cSvVYUvr8Ychx05swXwkvi3KvMQdVFDJpTy98wuv_2isJpifpDn4z1yrvtEa2RhBM8dXfimXAjgX-t-YJm-u1PIvvZOxfEcgndSLbgY8rYhOKFA/s16000/Screenshot_48.png)

and many more...


## Run Locally

Clone the project

```bash
  git clone https://github.com/mudithatharuka/Block_Buster.git
```

Import the database

You can use the default settings as in the project.

- Create a database called "*blockbusterb*" using your favorite DBMS software (Like PhpMyAdmin).
- Import the "*block_buster.sql*" file from "*Block_Buster/databases/*" folder to the newly created "*blockbusterb*" database.

Otherwise you can use your own settings.

- Create a database with your preferred name using your favorite DBMS software (Like PhpMyAdmin).
- Import the "*block_buster.sql*" file from "*Block_Buster/databases/*" folder to the newly created database.
- Make sure to change the database name in the "*connection.php*" file in the "*Block_Buster/inc/*" folder with the name you used when creating the database.

![App Screenshot](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg7kWseO5KuCHkv0UNEMvu6gbkkZEgRCiLRokuLGNEElTzOSYLLFnJFQYlyqmKX0g2ZXn_og-xLwTo0oPEcXd5XV3--9GzggfCxzfnbifIyAV3vNQ4Ol2lIFJ7LUyZ__ncqkYP6jIaE9OwzshVfcEZi5kHgUvBBDUvbQjXET0EHmH45iAX2Jdz6nH2EqA/s16000/Screenshot_51.png)


If you have different password and a username for the DBMS software, make sure to change them too in the "*connection.php*" file.

Start your local web and MySql server

Load the website in the browser with localhost

```bash
  http://localhost:[your_port_number]/Block_Buster
```

Add movies, TV series and celebrities by login to the admin panel

![App Screenshot](https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi-PtxIAa1V4goc7BJzfneKnpjsWk7VYu4Rxd5BC9kVS0rv_JMsRMXGBC_H4gXGDlLOjvFC5ezqSEQKRAHZNcB4UNQZSc0Vo3umey_6roS3ekQwBecGqYRP8S-rTE-uebdjrGHvELza-z4q5OlJK0_lMf6QFW6BOtSk_pUT6qmMgKCK5A7J56nkBWTH4A/s16000/Screenshot_49.png)


- First create an account in admin panel, go to:

```bash
  http://localhost:[your_port_number]/Block_Buster/adminsignup.php
```
- then login to your admin account, go to 

```bash
  http://localhost:[your_port_number]/Block_Buster/adminlogin.php
```
- Add movies, TV series and many more...## Color Reference

| Color             | Hex                                                                |
| ----------------- | ------------------------------------------------------------------ |
| Theme Color | ![#dd003f](https://via.placeholder.com/10/dd003f?text=+) #dd003f |
| Background Color | ![#020d18](https://via.placeholder.com/10/020d18?text=+) #020d18 |
| Sub Color 1 | ![#0b1a2a](https://via.placeholder.com/10/0b1a2a?text=+) #0b1a2a |
| Example Color | ![#233a50](https://via.placeholder.com/10/233a50?text=+) #233a50 |

