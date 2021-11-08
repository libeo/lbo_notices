.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

Define a new type of link
===============

The extension can force user to be redirected if some notices should be displayed. The notice's level at which it happen can be configured.

.. code-block:: typoscript
    plugin.tx_lbonotices {
        levelRedirect = 3
    }
