-- Renova Marketing Solutions — Portfolio Database
-- Import this in phpMyAdmin (select u766839992_renova_db first, then Import)

CREATE TABLE IF NOT EXISTS portfolio_items (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(255)    NOT NULL,
  category    VARCHAR(50)     NOT NULL,
  description TEXT,
  image       VARCHAR(500)    DEFAULT NULL,
  client      VARCHAR(255)    DEFAULT NULL,
  year        YEAR            DEFAULT NULL,
  tags        VARCHAR(500)    DEFAULT NULL,
  status      TINYINT(1)      NOT NULL DEFAULT 1,
  sort_order  INT             NOT NULL DEFAULT 0,
  created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,
  updated_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin_users (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(100) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin: username=admin  password=Renova@2025
INSERT INTO admin_users (username, password) VALUES
  ('admin', '$2y$12$YKqxsHqXmPFkFV3cj7mWKeJyHZTbIBbq.U.0XNrTLrgBOxK3Kn.9u');

-- Sample portfolio data
INSERT INTO portfolio_items (title, category, description, client, year, tags, status, sort_order) VALUES
  ('Corporate Website',       'website',   'Professional multi-page website with animations and lead generation forms.',       'Tech Corp USA',    2024, 'HTML,CSS,JavaScript,GSAP',  1, 1),
  ('Brand Identity Design',   'branding',  'Full brand system — logo, typography, color palette, and brand guidelines.',      'StartUp Canada',   2024, 'Logo,Brand,Typography',     1, 2),
  ('Business Dashboard',      'webapp',    'Real-time analytics dashboard with role-based access and data export.',           'FinTech Inc',      2024, 'PHP,MySQL,Charts',          1, 3),
  ('iOS & Android App',       'mobile',    'Cross-platform mobile app with booking system and push notifications.',           'BookEasy',         2023, 'Flutter,Firebase',          1, 4),
  ('Online Store',            'ecommerce', 'Full e-commerce solution with inventory management and payment integration.',     'RetailPlus',       2024, 'WooCommerce,Stripe',        1, 5),
  ('Logo & Brand Identity',   'branding',  'Custom logo design with a complete brand identity package for a startup.',       'GreenLeaf Co',     2023, 'Logo,Illustrator',          1, 6),
  ('Organic Growth Campaign', 'marketing', '320% traffic increase in 6 months through technical SEO and content strategy.',  'LocalBiz Toronto', 2024, 'SEO,Content,Analytics',     1, 7),
  ('Restaurant Ordering App', 'mobile',    'Food ordering app with real-time tracking, loyalty rewards, and POS integration.','TasteHub',        2024, 'React Native,Node.js',      1, 8),
  ('Real Estate Platform',    'website',   'Property listing website with search filters, map integration, and inquiry forms.','PropFind',        2023, 'PHP,MySQL,Google Maps',     1, 9),
  ('Social Media Campaign',   'marketing', '6-month brand awareness campaign with content creation and paid ads management.','StyleCo',          2024, 'Meta Ads,Content',          1, 10),
  ('SaaS Project Manager',    'webapp',    'Multi-tenant SaaS app for project management with team collaboration tools.',    'PlanPro',          2024, 'Laravel,Vue.js,MySQL',      1, 11),
  ('Product Photography',     'branding',  'Commercial product photography and video content for an e-commerce brand.',      'LuxeGoods',        2023, 'Photography,Video,Editing', 1, 12);
