# KP PINGER SYSTEM🌐
> **Advanced Network Topology & Multi-Tenant Monitoring System**

**KP PINGER SYSTEM** is a modern, high-performance web application designed for real-time geographic and topological infrastructure monitoring. Engineered specifically to cater to municipal agencies and regional government sectors (**OPDs - *Organisasi Perangkat Daerah***) in Kulon Progo, this platform delivers a unified interface for centralized administration while enforcing strict, secure data isolation for individual tenants.

---

## ⚙️ Core Features

* **Multi-Tenant Data Isolation (Multi-OPD):** Context-aware routing ensures individual regional sectors (e.g., *Badan Kesatuan Bangsa dan Politik*, *Dinas Kesehatan*) can only view, provision, and manage network nodes within their specific operational boundary.
* **Omnipotent Admin Controls:** While standard tenants are locked to their respective data pools, **Super Admins** retain system-wide data visibility, master registration controls, and overarching orchestration rights.
* **Live Geographic Status Dashboard:** Integrated with Leaflet.js and styled using high-fidelity *CartoDB Voyager* basemaps. Features automated coordinate stacking, interactive spatial markers, and real-time nested micro-badges for up/down telemetry and IP bindings.
* **Logical Link Interconnection:** A robust relational backend maps inter-device network pipelines (*Source ➔ Target*). OPD operators are strictly gated to binding connections originating from their native nodes to prevent cross-tenant misconfigurations.
* **Dynamic Regional Registries:** Utilizes localized database seeders to natively provision structured municipal registers, streamlining the onboarding of new departments with zero textual inconsistencies.
* **Premium UI/UX Aesthetics:** Designed with an elegant custom dark-mode sidebar, micro-glow active indicators, responsive collapsible forms via Alpine.js, and highly descriptive validation alert indicators.

---

## 🚀 Tech Stack

* **Backend Framework:** Laravel 10.x / 11.x (PHP 8.2+)
* **Frontend Architecture:** Tailwind CSS, Alpine.js, Blade Components
* **Geospatial Layer:** Leaflet.js API (CartoDB Vector Matrix)
* **Database Engine:** MySQL (Eloquent ORM & Relational Constraints)
* **Authentication & Access Control:** Enhanced Multi-Role RBAC Guards (Super Admin, Admin, Viewer)

---

## 🔒 License & Copyright

**PROPRIETARY & CONFIDENTIAL**

Copyright (c) 2026 Komdigi Kulon Progo (Kulon Progo Communications and Information Office). All rights reserved.

This software and its associated documentation files (the "Software") are proprietary to and the sole property of **Komdigi Kulon Progo**. 

**COMMERCIAL AND NON-COMMERCIAL DISTRIBUTION, MODIFICATION, REPRODUCTION, OR USE OF THIS SOFTWARE BY ANY INDIVIDUAL, ORGANIZATION, OR ENTITY OTHER THAN KOMDIGI KULON PROGO IS STRICTLY PROHIBITED WITHOUT PRIOR WRITTEN CONSENT.**
