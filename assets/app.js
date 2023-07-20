/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

// $(document).ready(function() {
//     $('[data-toggle="popover"]').popover();
// });

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './images/liste-course.jpg';

import DataTable from 'datatables.net-bs5';

/// trie + pagination index admin ///

const tableShoppingList = document.getElementById('shoppingList_list');
const tableProduct = document.getElementById('product_list');
const tableCategory = document.getElementById('category_list');
const tableStore = document.getElementById('store_list');

if(tableShoppingList){
    new DataTable(tableShoppingList);
}

if(tableProduct){
    new DataTable(tableProduct);
}

if(tableCategory){
    new DataTable(tableCategory);
}

if(tableStore){
    new DataTable(tableStore);
}

/// check list ///

const accordionShoppingList = document.getElementById('accordionShoppingList');

if (accordionShoppingList) {
    const shoppingListItems = accordionShoppingList.getElementsByTagName("ol");

    for (let shoppingListItem of shoppingListItems) {
        shoppingListItem.addEventListener('click', function (event) {

            const shoppingListItemId = shoppingListItem.dataset.id;

            fetch('/shopping-list-item/' + shoppingListItemId + '/checked')
                .then(response => response.json())
                .then(json => {
                    if ("success" === json) {
                        const liItem = shoppingListItem.getElementsByTagName("li")[0];
                        liItem.classList.toggle('text-black-50');
            
                        const iconCheck = shoppingListItem.getElementsByTagName("i")[0];
                        iconCheck.classList.toggle('d-none')
                    }
                });
        })
    }
}

