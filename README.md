# Product Badge

This extension adds developer-friendly, programmable badges to Magento.

![Alt text](https://cloud.githubusercontent.com/assets/2853953/26014481/bece5776-372a-11e7-8957-5fd1cd5f8ae5.png "Product Badge")

## How it works

This extension adds a section into System > Configuration > Catalog > Product Badge Options that allows users to configure and create badges. A "Badge" product attribute is also added into the product configuration.

Each badge is created with a *label* and a *class* which allow the developer to style the badges differently on the frontend.

Take following steps in order to add a new badge.

**Step 1:**
Add new class to [productbadge.css](https://github.com/pratiknikam/SomethingDigital_ProductBadge/blob/master/skin/frontend/base/default/css/somethingdigital/productbadge.css) in following format.

```
.badge--percent-off-90 {
  background: url("../images/badges/90Off-Icons.png") no-repeat scroll 0 0;
  background-position: center center;
  background-size: 100% 100%;
  background-color: transparent !important;
}
```

**Step 2:**
Add badge image to appropriate location.

**Step 3:**
Add new badge option at System > Configuration > Catalog > Product Badge Options > Add New Badge

![image](https://cloud.githubusercontent.com/assets/2853953/25955639/d06ad3b8-3637-11e7-9d75-f17f8ff1f41b.png)

**Step 4:**
Assign badge to a product by going to product configuration.

![image](https://cloud.githubusercontent.com/assets/2853953/25955701/f0d5db84-3637-11e7-833d-47e6b8e3d6ba.png)

**Step 5:**
Flush cache.

## Reference

You can refer PR https://github.com/sdinteractive/Papyrus-PapyrusOnline/pull/1087 where we added extension to papyrus repo. (not through modman though)