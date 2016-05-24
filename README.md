Hexagonal BDD
=============

Hi, this is an example project for the Hexagonal BDD tutorial.

Getting started
---------------

To prepare for the tutorial, make sure you have [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) installed and then run:

```sh
hexagonal-bdd$ composer install
```

Next, make sure you have [Vagrant](https://www.vagrantup.com/docs/installation/) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads) installed, as well as [Ansible](http://docs.ansible.com/ansible/intro_installation.html), and then run:

```sh
hexagonal-bdd$ vagrant up
```

That's it!

Making sure it works
--------------------

Opening the following URL in the browser should show a Symfony test page: http://192.168.33.99/app_dev.php.

Next, SSH into your Vagrant box:

```sh
hexagonal-bdd$ vagrant ssh
```

If you go to the `/vagrant` folder and run PHPSpec, you should see the following output:

```sh
~$ cd /vagrant
/vagrant$ vendor/bin/phpspec run
                                                                                 0
0 specs
0 examples
0ms
```
