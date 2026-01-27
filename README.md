# WeighDash

WeighDash is a web-based monitoring dashboard for factory weighing transactions, providing real-time insights into truck registration flow, inbound and outbound weighing status, transaction types, and total tonnage.

---

## 🚛 Overview
WeighDash is designed to support operational and management teams in monitoring the end-to-end weighing process within a factory or industrial environment.

The dashboard presents real-time transaction data, truck movement status, and tonnage summaries to help ensure transparency, efficiency, and accurate operational tracking.

---

## ✨ Key Features
- Real-time monitoring of truck transaction stages:
  - Registration In
  - Weigh In
  - Weigh Out
  - Registration Out
- Transaction type classification
- Total tonnage calculation and aggregation
- Dashboard summary with clear visual indicators
- Responsive and user-friendly interface using AdminLTE

---

## 🔄 Transaction Flow
1. Truck registers upon entering the factory
2. Truck performs inbound weighing
3. Truck performs outbound weighing
4. Truck registers upon exiting
5. System calculates transaction summary and total tonnage

---

## 🛠️ Tech Stack

### Frontend
- HTML5
- CSS3
- JavaScript
- AdminLTE (Admin Dashboard Template)
- jQuery (for AJAX and real-time data updates)

### Backend
- PHP
- Laravel Framework
- RESTful API for transaction data

### Database
- MySQL

---

## 📊 Dashboard Highlights
- Total trucks per transaction stage
- Breakdown of transaction types
- Total tonnage summary
- Near real-time data updates using AJAX polling
- Operational overview for daily monitoring

---

## 🔌 Data Communication
The frontend dashboard consumes data through RESTful APIs built with Laravel.
jQuery AJAX is used to periodically fetch and refresh transaction data without reloading the page.

---

## 📌 Notes
This project is intended for industrial weighing operations and can be further enhanced with:
- Authentication & role-based access
- Historical reporting
- Export to Excel / PDF
