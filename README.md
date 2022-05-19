# Storefront Coding Challenge

In this challenge you’re tasked with creating a storefront to help company x create a billing form for their store.

When the page loads there should be one row with the following input fields:
1. Description - Holds the item name.
2. Cost - Holds the price of the item.
3. Quantity - Holds the number of items.
4. VAT - Holds the value added tax for that item in percentage.
5. Total - Displays the cost of the item exclusive of value added tax.
6. Actions - A menu that pops a delete row/item option.

The **Add Item** button adds another row below the existing ones.
The **Delete Row** button in actions removes a row from the form.

The form is reactive hence the totals are calculated every time an input field is updated (excluding the description). 