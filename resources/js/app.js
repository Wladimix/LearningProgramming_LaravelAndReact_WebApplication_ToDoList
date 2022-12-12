import 'bootstrap/dist/css/bootstrap.min.css';
import React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import TaskManager from './components/TaskManager';


if (document.getElementById('reactContent')) {
    const taskManager = ReactDOMClient.createRoot(document.getElementById('reactContent'));
    let userId = document.getElementById('reactContent').getAttribute('userId');
    let userName = document.getElementById('reactContent').getAttribute('userName');
    let userPatronymic = document.getElementById('reactContent').getAttribute('userPatronymic');
    taskManager.render(<TaskManager userId={userId} userName={userName} userPatronymic={userPatronymic}/>);
}
