# Purchasing Assistant (دستیار خرید)

This project is a web application designed to streamline the purchasing process for businesses. It is based on a proposal for a system that aims to increase transparency, reduce costs, and accelerate procurement.

## Core Features (as per proposal)

*   **Centralized Supplier Database:** Manage all supplier information in one place.
*   **Automated Inquiry Process:** Automatically send out requests for quotes (RFQs) to selected suppliers.
*   **Supplier Dashboard:** Allow suppliers to log in, view RFQs, and submit their quotes and conditions.
*   **Management Dashboard:** Provide a comparative view of quotes for easy decision-making by managers.
*   **Time-Limited Bidding:** Create urgency by setting deadlines for quote submissions.
*   **Flexible Rules Engine:** Adapt the purchasing workflow to different company policies.
*   **Accounting Software Integration:** Designed to be connectable to various accounting systems.

## Current Status

The project is in the initial development phase. The basic file structure, database schema, and a simple homepage have been set up.

## Tech Stack

*   **Backend:** PHP
*   **Database:** MySQL (or compatible)

## Setup

1.  Place the project files on a web server with PHP support.
2.  Import the `database/schema.sql` into your MySQL database.
3.  Update the database credentials and application URL in `config.php`.
4.  Point your web server's document root to the `public/` directory.
5.  Access the application through your configured URL.