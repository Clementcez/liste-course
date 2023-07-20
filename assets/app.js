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

