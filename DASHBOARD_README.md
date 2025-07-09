# User Dashboard System

## Overview

تم إنشاء نظام Dashboard شامل للمستخدمين يتيح لهم إدارة حساباتهم وطلباتهم بشكل كامل.

## Features المميزات

### 1. Dashboard الرئيسي

-   عرض إحصائيات المستخدم (إجمالي الطلبات، الطلبات المعلقة، المكتملة، قائمة الأمنيات)
-   عرض الطلبات الحديثة
-   عرض المنتجات المتصفحة مؤخراً

### 2. إدارة الملف الشخصي

-   تحديث المعلومات الشخصية
-   رفع صورة شخصية
-   تغيير كلمة المرور
-   إعدادات الإشعارات

### 3. إدارة العناوين

-   إضافة عناوين متعددة (منزل، عمل، أخرى)
-   تحديد عنوان افتراضي
-   تعديل وحذف العناوين

### 4. إدارة الطلبات

-   عرض جميع الطلبات مع التفاصيل
-   تتبع حالة الطلبات
-   عرض تفاصيل كل طلب

### 5. قائمة الأمنيات (Wishlist)

-   إضافة المنتجات المفضلة
-   إزالة المنتجات من القائمة
-   إضافة المنتجات إلى السلة مباشرة

### 6. سجل التصفح

-   عرض المنتجات المتصفحة مؤخراً
-   إمكانية مسح السجل
-   إضافة المنتجات إلى السلة أو قائمة الأمنيات

### 7. تتبع الطلبات

-   عرض رقم التتبع
-   مراحل الشحن والتسليم
-   تحديثات الحالة

### 8. طلبات الإرجاع

-   تقديم طلبات إرجاع المنتجات
-   تتبع حالة طلبات الإرجاع
-   رفع صور للمنتجات المعيبة

### 9. إدارة السلة

-   عرض المنتجات في السلة
-   تحديث الكميات
-   حساب الإجماليات
-   الانتقال للدفع

## Database Tables الجداول

### 1. user_addresses

-   id, user_id, type, title
-   first_name, last_name, phone
-   address_line_1, address_line_2
-   city, state, postal_code, country
-   is_default, notes, timestamps

### 2. wishlists

-   id, user_id, product_id, timestamps
-   unique(user_id, product_id)

### 3. user_browsing_history

-   id, user_id, product_id, viewed_at, timestamps
-   index(user_id, viewed_at)

### 4. return_requests

-   id, user_id, order_id, order_item_id
-   return_number, reason, description, images
-   status, refund_amount, admin_notes
-   requested_at, processed_at, timestamps

## Routes المسارات

جميع المسارات محمية بـ middleware('auth') وتحت prefix('dashboard')

-   GET /dashboard - الصفحة الرئيسية
-   GET /dashboard/profile - إدارة الملف الشخصي
-   PUT /dashboard/profile - تحديث الملف الشخصي
-   GET /dashboard/addresses - إدارة العناوين
-   POST /dashboard/addresses - إضافة عنوان جديد
-   PUT /dashboard/addresses/{id} - تحديث عنوان
-   DELETE /dashboard/addresses/{id} - حذف عنوان
-   GET /dashboard/orders - قائمة الطلبات
-   GET /dashboard/orders/{id} - تفاصيل الطلب
-   GET /dashboard/wishlist - قائمة الأمنيات
-   DELETE /dashboard/wishlist/{id} - إزالة من قائمة الأمنيات
-   GET /dashboard/browsing-history - سجل التصفح
-   DELETE /dashboard/browsing-history - مسح سجل التصفح
-   GET /dashboard/return-requests - طلبات الإرجاع
-   GET /dashboard/cart - إدارة السلة
-   GET /dashboard/tracking - تتبع الطلبات

## Models النماذج

### UserAddress

-   العلاقات: belongsTo User
-   الخصائص: full_name, full_address

### Wishlist

-   العلاقات: belongsTo User, belongsTo Product

### UserBrowsingHistory

-   العلاقات: belongsTo User, belongsTo Product
-   مرتب حسب viewed_at desc

### ReturnRequest

-   العلاقات: belongsTo User, Order, OrderItem
-   الخصائص: status_color, reason_text

## Views الواجهات

### بنية الملفات

```
buyer/dashboard/
├── layout.blade.php (التخطيط الأساسي مع الشريط الجانبي)
├── index.blade.php (الصفحة الرئيسية)
├── profile.blade.php (إدارة الملف الشخصي)
├── addresses.blade.php (إدارة العناوين)
├── orders.blade.php (قائمة الطلبات)
├── order-details.blade.php (تفاصيل الطلب)
├── wishlist.blade.php (قائمة الأمنيات)
├── browsing-history.blade.php (سجل التصفح)
├── tracking.blade.php (تتبع الطلبات)
├── return-requests.blade.php (طلبات الإرجاع)
└── cart.blade.php (إدارة السلة)
```

### مميزات التصميم

-   تصميم متجاوب مع Bootstrap
-   تخطيط حديث قائم على البطاقات
-   نظام ألوان متسق
-   عناصر تفاعلية مع تأثيرات hover
-   شريط جانبي متوافق مع الهواتف
-   حالات التحميل والرسوم المتحركة

## الأمان والحماية

### المصادقة والتفويض

-   جميع المسارات محمية بـ auth middleware
-   التحقق من ملكية المستخدم للموارد
-   حماية CSRF على جميع النماذج
-   التحقق من صحة المدخلات

### حماية البيانات

-   التحقق من رفع الملفات للصور الشخصية
-   قيود حجم ونوع الصور
-   منع SQL injection
-   حماية XSS

## JavaScript Features

### العناصر التفاعلية

-   عمليات السلة بـ AJAX
-   معاينة الصور للملف الشخصي
-   التعامل الديناميكي مع النماذج
-   تفاعلات النوافذ المنبثقة
-   التحديثات الفورية

## Installation & Setup

### 1. تشغيل Migrations

```bash
php artisan migrate
```

### 2. تحديث التنقل في الهيدر

تم تحديث القائمة المنسدلة في الهيدر لتشمل روابط Dashboard.

### 3. التأكد من التبعيات

-   Bootstrap 5 للتصميم
-   Font Awesome للأيقونات
-   jQuery للتفاعلات (اختياري)

## الاستخدام

### الوصول للـ Dashboard

```
/dashboard - الصفحة الرئيسية
/dashboard/profile - إدارة الملف الشخصي
/dashboard/orders - قائمة الطلبات
/dashboard/wishlist - قائمة الأمنيات
```

## التحسينات المستقبلية

### الميزات المخططة

1. نظام إشعارات الطلبات
2. تصفية وبحث متقدم
3. تصدير تاريخ الطلبات
4. مشاركة قائمة الأمنيات اجتماعياً
5. توصيات المنتجات
6. نقاط API للتطبيق المحمول
7. لوحة تحليلات متقدمة
8. دعم متعدد اللغات

### تحسينات الأداء

1. تنفيذ التخزين المؤقت للبيانات المتكررة
2. إضافة ترقيم للمجموعات الكبيرة
3. تحسين استعلامات قاعدة البيانات
4. إضافة فهرسة البحث
5. تنفيذ التحميل التدريجي للصور

---

تم إنشاء هذا النظام بعناية لتوفير تجربة مستخدم ممتازة وإدارة شاملة للحسابات والطلبات.
