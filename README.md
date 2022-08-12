<div id="top"></div>
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/DU-EDU-SY/SPMS">
    <img src="./Logo.png" alt="Damascus University" width="180" height="160">
  </a>

  <h3 align="center">Students Project Management System</h3>

  <p align="center">
    An awesome way to manage your student's projects!
    <br />
    <a href="https://github.com/DU-EDU-SY/SPMS/issues">Report Bugs</a>
    ·
    <a href="https://github.com/DU-EDU-SY/SPMS/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

Our current era is known as the era of the technological revolution and the explosion of knowledge. The last decade of the twentieth century and the beginning of the twenty-first century witnessed tremendous progress in the field of information technology, and modern technological means have transformed the world into a small global village.
This development was reflected in many fields, but the field that benefited greatly from it was education; Technology has helped to find many means and tools that facilitated the educational process and made it more in line with the developments of the times, the issue of the presence of technology in the field of education is inevitable, as the field of education witnessed a great boom in the late twentieth century.
<br/>
Public and private educational institutions competed to find and provide effective means that help the student to learn easily and provide him with the ability to be creative effectively in study and in his future work. The employment of technology in the educational process facilitates the process of communication and communication between the student and the teacher, as well as facilitating many administrative processes, such as converting some paper processes into electronic ones. This will lead to the development of administrative work, reducing paperwork, and improving services by reducing mobility. Between departments for the circulation of business between employees, and to facilitate access to information at any time and place, and this in turn will lead to an increase in the speed in the completion of work and reduce the costs of administrative work while raising the level of performance in addition to the possibility of overcoming the problem of the geographical and temporal dimensions, developing the work mechanism and keeping pace with developments.
<br/>
Based on this point, the project team worked on building an electronic system for managing graduation projects at the Damascus University, through which administrative processes such as coordination and supervision of graduation projects were automated and creating a more interactive and developed environment in line with the university’s goals and orientations towards keeping pace with development and using technology in the service of education and make it more efficient and effective.

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

* [Laravel](https://laravel.com)
* [TailwindCss](https://tailwindcss.com/)
* [JQuery](https://jquery.com)
* [AlpineJs](https://alpinejs.dev/)
* [Rest API](https://docs.github.com/en/rest)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Make sure you have all the prerequisites and either pull the project using your favorite tool or download it manually.

### Prerequisites

Make sure you have all the prerequisites before moving to the next section.
* npm^8.1.0
  ```sh
  sudo apt install nodejs.
  ```
* php^8.1.5
  ```sh
  sudo apt-get install php
  ```
* composer^2.1.11
  ```sh
  php composer-setup.php --install-dir=bin
  ```

### Installation

_Below is how you install and setup up your own version of the app._ 

1. Clone the repo
   ```sh
   git clone https://github.com/DU-EDU-SY/SPMS.git
   ```
   Or you can download the files manually.

2. Install NPM packages
   ```sh
   npm install
   ```
3. Install Composer packages
   ```sh
   Composer install && Composer update
   ```
4. Copy .env.example file to .env on the root folder.
   ```sh
   cp .env.example .env
   ```

5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration add (GITHUB_ID), (GITHUB_SECRET), (GITHUB_URL), (GITHUB_TOKEN) From your github.

6. Generate a key.
   ```sh
   php artisan key:generate
   ```

7. Migrate database.
   ```sh
   php artisan php artisan migrate --seed
   ```
8. Serve project.
   ```sh
   php artisan serve
   ```
Now you should be able to login with the default administrator account ibrahemalnasser3@gmail.com and password 12345678 which you can change later.
   
<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Create a new user, give them permission to create a group, create a group the create a project and all your work will be uploaded to github.
_For more details on how to use the project, please refer to the Documentation._

<p align="right">(<a href="#top">back to top</a>)</p>

## Contact

Ibrahem Al Nasser - ibrahemalnasser3@gmail.com

Project Link: [https://github.com/DU-EDU-SY/SPMS](https://github.com/DU-EDU-SY/SPMS)

<p align="right">(<a href="#top">back to top</a>)</p>
