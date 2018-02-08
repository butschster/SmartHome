import Vue from 'vue';
import lang  from 'element-ui/lib/locale/lang/ru-RU';
import locale from 'element-ui/lib/locale';

import '../sass/element-variables.scss';
import {
    DatePicker,
    //Button,
    Checkbox,
    Upload,
    Switch,
    Message,
    MessageBox,
    Notification,
    Loading
} from 'element-ui';

locale.use(lang);
Vue.component(Switch.name, Switch);
Vue.component(Upload.name, Upload);
Vue.component(DatePicker.name, DatePicker)
Vue.component(Checkbox.name, Checkbox);
Vue.use(Loading.directive);

Vue.prototype.$loading = Loading.service;
Vue.prototype.$message = Message;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$notify = Notification;