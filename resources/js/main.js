import AppService from "./modules/app.service";
import './modules/header.component'
import '../css/style.css';
import '../less/style.less';
let test = new AppService('hello world!');
test.log();
