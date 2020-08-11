<!--<div align="center">
  <img width="400px" src="https://github.com/haryelramalho/rondon-project/blob/master/projects/assets/images/logo_navbar.svg" alt"Rondon" title="Rondon" />
</div>

<!--<br/>-->

<div align="center">
  <img src="https://github.com/haryelramalho/rondon-project/blob/master/projects/assets/images/screens-rondon.png" alt="Rondon Screens" title="Screens" />
</div>

# :pushpin: Table of contents

- [Description](#pencil-description)
- [Technologies](#computer-technologies)
- [How to run](#construction_worker-how-to-run)
  - [Downloading](#computer-downloading-project)
  - [Running](#computer-running-project-on-a-web-browser)
- [Authors](#handshake-authors)
- [License](#closed_book-license)

# :pencil: Description

<div>
    Monolithic application created to manage the event (IV Congresso Nacional do Projeto Rondon), which happened in 2019 at the university Universidade Estadual de Santa Cruz. The system has features like:

- Different user levels and permissions
- Subscription types that differ from each other
- Articles submission and evaluation
- Accommodation system for the event participants

Once the event reached its end and the service was turned off, we decided to share the code in order to contribute with the development community.

</div>

# :computer: Technologies

This project was made using the following technologies:

<ul>
  <li><a href="https://www.php.net/">PHP</a></li>
  <li><a href="https://jquery.com/">Jquery</a></li>
</ul>

# :construction_worker: How to run

### :gear: Prerequisites

<ul>
  <li><a href="https://docs.docker.com/get-docker/">Docker</a></li>
  <li><a href="https://docs.docker.com/compose/gettingstarted/">Docker Compose</a></li>
</ul>

### :computer: Downloading project

```bash
# Clone repository into your machine
$ git clone https://github.com/haryelramalho/rondon-project.git
```

### 💻 Running project on a web browser

Start the compose:

```bash
$ docker-compose up
```

Copy the .sql file into the container:

```bash
$ cp projects/database/rondon.sql mysql/rondon
```

Run an action inside the container in order to access at the terminal:

```bash
$ docker exec -it -w /var/lib/mysql/rondon rondon-project_mysql_1 /bin/bash
```

Access MySQL controls:

```bash
$ mysql -uroot -proot --host=mysql
```

Run the database initialization file:

```bash
$ source rondon.sql
```

Enjoy!

The application is located on http://localhost:80/ and we created initial user and admin credentials, but you may create you own account if it's your desire. The credentials are:

User:
```
email: user@mail.com
password: pass
```

Admin:
```
email: admin
password: admin
```

# :handshake: Authors

| [<img src="https://avatars2.githubusercontent.com/u/38708454?v=3&s=115"><br><sub>@haryelramalho</sub>](https://github.com/haryelramalho) | [<img src="https://avatars1.githubusercontent.com/u/31571238?v=3&s=115"><br><sub>@brenu</sub>](https://github.com/brenu) | [<img src="https://avatars1.githubusercontent.com/u/32274254?s=115&v=3"><br><sub>@ariel-narciso</sub>](https://github.com/ariel-narciso) | [<img src="https://avatars0.githubusercontent.com/u/43353102?s=115&v=3"><br><sub>@nozinho</sub>](https://github.com/nozinho) | [<img src="https://avatars0.githubusercontent.com/u/27397817?s=115&v=3"><br><sub>@christianmoliveira</sub>](https://github.com/christianmoliveira) |
| :--------------------------------------------------------------------------------------------------------------------------------------: | :----------------------------------------------------------------------------------------------------------------------: | :--------------------------------------------------------------------------------------------------------------------------------------: | :--------------------------------------------------------------------------------------------------------------------------: | :------------------------------------------------------------------------------------------------------------------------------------------------: |


# :closed_book: License

Released in 2020.

This project is under the [MIT license](https://github.com/haryelramalho/rondon-project/blob/master/LICENSE).

Made with passion by [Haryel Ramalho](https://github.com/haryelramalho) & [Breno Vitório](https://github.com/brenu) 🚀

Give it a ⭐️ if this project helped you!
