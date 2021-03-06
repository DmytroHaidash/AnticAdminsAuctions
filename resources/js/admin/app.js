require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal';

import Wysiwyg from './components/Wysiwyg/Editor';
import BlockEditor from './components/BlockEditor';
import Options from  './components/Options';
import MultiUploader from './components/MultiUploader';
import SingleUploader from './components/SingleUploader';
import PasswordChange from './components/PasswordChange';
import LotsPage from './components/lots/LotsPage';

Vue.use(VModal);

new Vue({
  el: '#app',
  components: {
    BlockEditor,
    Wysiwyg,
    Options,
    MultiUploader,
    SingleUploader,
    PasswordChange,
    LotsPage
  },
  mounted() {
    require('./modules/notifications');
    require('./modules/phone-mask');
  }
});

