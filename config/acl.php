<?php
return [
    'permissions' => [
        'root' => ['admin', 'store', 'customer'],
        'dashboard' => ['super admin'],
        'signout' => ['super admin', 'admin', 'store', 'customer'],
        //Subscriptions
        'subscription.index' => ['super admin'],
        'subscription.store' => ['super admin'],
        'subscription.status.chanage' => ['super admin'],
        'subscription.update' => ['super admin'],
        'subscription.report' => ['super admin', 'admin'],
        //Payment Gateway
        'payment-gateway.index' => ['super admin'],
        'payment-gateway.update' => ['super admin'],
        'payment.method' => ['admin'],
        'payment.process' => ['admin'],
        //Subscriptions
        'subscription.purchase.index' => ['admin'],
        'subscription.purchase.update' => ['admin'],
        //Product route
        'product.index' => ['admin'],
        'product.create' => ['admin'],
        'product.store' => ['admin'],
        'product.edit' => ['admin'],
        'product.update' => ['admin'],
        'product.destroy' => ['admin'],
        'product.sale.unit' => ['admin'],
        'product.generate.code' => ['admin'],
        'product.barcode.generate' => ['admin'],
        'barcode.print' => ['admin'],
        'product.search' => ['admin'],
        'product.details' => ['admin'],
        'product.import' => ['admin'],
        'download.product.sample' => ['admin'],
        'product.print' => ['admin'],
        //Stock Count route
        'stock.count.index' => ['admin'],
        'stock.count.store' => ['admin'],
        //Purchase route
        'purchase.index' => ['admin'],
        'purchase.create' => ['admin'],
        'purchase.store' => ['admin'],
        'purchase.edit' => ['admin'],
        'purchase.update' => ['admin'],
        'purchase.destroy' => ['admin'],
        'purchase.add.payment' => ['admin'],
        'purchase.delete.payment' => ['admin'],
        'purchase.batch' => ['admin'],
        'purchase.print' => ['admin'],
        //category route
        'category.index' => ['admin'],
        'category.store' => ['admin'],
        'category.update' => ['admin'],
        'category.delete' => ['admin'],
        'category.import' => ['admin'],
        'download.category.sample' => ['admin'],
        'category.print' => ['admin'],
        //Expense Category route
        'expenseCategory.index' => ['admin'],
        'expenseCategory.store' => ['admin'],
        'expenseCategory.update' => ['admin'],
        'expenseCategory.destroy' => ['admin'],
        'expenseCategory.code' => ['admin'],
        //Expense route
        'expense.index' => ['admin'],
        'expense.store' => ['admin'],
        'expense.update' => ['admin'],
        'expense.destroy' => ['admin'],
        //Accounting route
        'account.index' => ['admin'],
        'account.store' => ['admin'],
        'account.update' => ['admin'],
        'account.update.balance' => ['admin'],
        'account.destroy' => ['admin'],
        'account.balancesheet' => ['admin'],
        //Money Transfer route
        'money.transfer.index' => ['admin'],
        'money.transfer.store' => ['admin'],
        'money.transfer.update' => ['admin'],
        'money.transfer.destroy' => ['admin'],
        //Money Transfer route
        'transection.index' => ['admin'],
        //Coupon route
        'coupon.index' => ['admin'],
        'coupon.store' => ['admin'],
        'coupon.update' => ['admin'],
        'coupon.destroy' => ['admin'],
        'coupon.apply' => ['admin', 'store'],
        //Supplier route
        'supplier.index' => ['admin'],
        'supplier.create' => ['admin'],
        'supplier.store' => ['admin'],
        'supplier.edit' => ['admin'],
        'supplier.update' => ['admin'],
        'supplier.destroy' => ['admin'],
        'supplier.import' => ['admin'],
        'download.supplier.sample' => ['admin'],
        //Customer route
        'customer.index' => ['admin'],
        'customer.create' => ['admin'],
        'customer.store' => ['admin'],
        'customer.edit' => ['admin'],
        'customer.update' => ['admin'],
        'customer.destroy' => ['admin'],
        'customer.import' => ['admin'],
        'download.customer.sample' => ['admin'],
        'customer.search' => ['admin', 'store'],
        'customer.add' => ['admin', 'store'],
        //User route
        'profile.index' => ['super admin', 'admin'],
        'profile.update' => ['super admin', 'admin'],
        'user.password' => ['admin', 'super admin'],
        'generate.password' => ['admin'],
        //Sale route
        'sale.index' => ['admin', 'store'],
        'sale.draft' => ['admin', 'store'],
        'sale.draft.delete' => ['admin', 'store'],
        'sale.print' => ['admin', 'store'],
        'sale.pos' => ['admin', 'store'],
        'sale.pos.store' => ['admin', 'store'],
        'sale.pos.data' => ['admin', 'store'],
        'sale.invoice.generate' => ['admin', 'store'],
        'sale.pdf.download' => ['admin', 'store'],
        //Report Route
        'report.summary' => ['admin'],
        //Sale Return Route
        'sale.return.index' => ['admin'],
        'sale.return.search' => ['admin'],
        'sale.return.details' => ['admin'],
        'sale.return.product.store' => ['admin'],
        //Role route
        'role.index' => ['admin'],
        'role.store' => ['admin'],
        'role.update' => ['admin'],
        'role.permission' => ['admin'],
        'role.set.permission' => ['admin'],
        //Warehouse route
        'warehouse.index' => ['admin'],
        'warehouse.store' => ['admin'],
        'warehouse.update' => ['admin'],
        'warehouse.delete' => ['admin'],
        //Customer group
        'customer.group.index' => ['admin'],
        'customer.group.store' => ['admin'],
        'customer.group.update' => ['admin'],
        'customer.group.delete' => ['admin'],
        //Brand route
        'brand.index' => ['admin'],
        'brand.store' => ['admin'],
        'brand.update' => ['admin'],
        'brand.delete' => ['admin'],
        //Unit route
        'unit.index' => ['admin'],
        'unit.store' => ['admin'],
        'unit.update' => ['admin'],
        'unit.delete' => ['admin'],
        //Currency route
        'currency.index' => ['super admin', 'admin'],
        'currency.store' => ['super admin', 'admin'],
        'currency.update' => ['super admin', 'admin'],
        'currency.delete' => ['super admin', 'admin'],
        //tax route
        'tax.index' => ['admin'],
        'tax.store' => ['admin'],
        'tax.update' => ['admin'],
        'tax.delete' => ['admin'],
        //Settings route
        'settings.general' => ['super admin', 'admin'],
        'settings.general.store' => ['super admin', 'admin'],
        'settings.mail' => ['super admin'],
        'settings.mail.store' => ['super admin'],
        'settings.database.backup' => ['super admin'],
        // Language
        'language.index' => ['super admin'],
        'language.create' => ['super admin'],
        'language.store' => ['super admin'],
        'language.edit' => ['super admin'],
        'language.update' => ['super admin'],
        'language.delete' => ['super admin'],
        //shop category route
        'shop.category.index' => ['super admin'],
        'shop.category.store' => ['super admin'],
        'shop.category.update' => ['super admin'],
        'shop.category.delete' => ['super admin'],
        'shop.category.status.chanage' => ['super admin'],
        //shop route
        'shop.index' => ['super admin'],
        'shop.create' => ['super admin'],
        'shop.store' => ['super admin'],
        'shop.update' => ['super admin'],
        'shop.delete' => ['super admin'],
        'shop.status.chanage' => ['super admin'],
        'shop.owner.reset.password' => ['super admin'],
        'shop.life.time.expire.chanage' => ['super admin'],
        'shop.subscription.chanage' => ['super admin'],
        //store route
        'store.index' => ['admin'],
        'store.create' => ['admin'],
        'store.edit' => ['admin'],
        'store.store' => ['admin'],
        'store.update' => ['admin'],
        'store.delete' => ['admin'],
        'store.status.chanage' => ['admin'],
        // department route
        'department.index' => ['admin'],
        'department.store' => ['admin'],
        'department.update' => ['admin'],
        'department.delete' => ['admin'],
        // employee route
        'employee.index' => ['admin'],
        'employee.create' => ['admin'],
        'employee.store' => ['admin'],
        'employee.edit' => ['admin'],
        'employee.update' => ['admin'],
        'employee.delete' => ['admin'],
        // attendance route
        'attendance.index' => ['admin'],
        'attendance.store' => ['admin'],
        'attendance.delete' => ['admin'],
        //holiday route
        'holiday.index' => ['admin'],
        'holiday.store' => ['admin'],
        'holiday.update' => ['admin'],
        'holiday.delete' => ['admin'],
        // payroll route
        'payroll.index' => ['admin'],
        'payroll.store' => ['admin'],
        'payroll.update' => ['admin'],
        'payroll.delete' => ['admin'],
    ],
];