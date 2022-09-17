require('./bootstrap');

import './components/table-datatable';
import './components/form-select2';
import './components/form-validation';
import './components/delete';
import './components/copy';
import {CreateCoor, DeleteCoor} from './components/form-input-coordinates';

var newcoor = '';

window.newcoor = newcoor;
window.CreateCoor = CreateCoor;
window.DeleteCoor = DeleteCoor;