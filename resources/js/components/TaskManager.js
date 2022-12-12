import React, { useState, useEffect } from "react";
import Table from "react-bootstrap/Table";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import ButtonGroup from 'react-bootstrap/ButtonGroup';
import Dropdown from 'react-bootstrap/Dropdown';
import DropdownButton from 'react-bootstrap/DropdownButton';
import Card from 'react-bootstrap/Card';
import Modal from "react-bootstrap/Modal";
import ModalWindow from "./ModalWindow";

import axios from "axios";
import {v4 as uuid} from 'uuid';


export default function TaskManager({userId, userName, userPatronymic}) {
    const [data, setData] = useState('');
    const [responceStatus, setResponceStatus] = useState('waiting for a response');
    const [membershipStatus, setMembershipStatus] = useState('');
    const [expirationDateStatus, setExpirationDateStatus] = useState('');
    const [isLeader, setIsLeader]  = useState(false);

    const [modalActive, setModalActive] = useState(false);
    const [statusModal, setStatusModal] = useState('');
    const [statusDeleteModal, setStatusDeleteModal] = useState('');

    const [titleTask, setTitleTask] = useState('');
    const [descriptionTask, setDescriptionTask] = useState('');
    const [expirationDate, setExpirationDate] = useState('');
    const [priorityTask, setPriorityTask] = useState('');
    const [responsible, setResponsible] = useState('');
    const [statusTask, setStatusTask] = useState('');

    const [taskCreator, setTaskCreator] = useState(userId);

    const [editableTaskId, setEditableTaskId] = useState('');

    const [allResponsibles, setAllResponsibles] = useState(<option value>Загрузка</option>);

    function generateId() {
        return uuid();
    };

    let tableBody;
    if (responceStatus === 'waiting for a response') {
        tableBody = <tr><td colSpan={6}>Загрузка данных</td></tr>;
    } else if (responceStatus === 'data loading error') {
        tableBody = <tr><td style={{backgroundColor: 'red', color: 'white'}} colSpan={6}>Ошибка загрузки данных</td></tr>;
    };

    let managerPanel;
    if (isLeader) {
        managerPanel = <Col md={{ span: 4, offset: 4 }}>
                <Card>
                    <Card.Body>
                        <Card.Text>
                            Панель руководителя
                        </Card.Text>
                        <Button size="sm" variant="warning" onClick={() => {setMembershipStatus('all tasks')}}>Все задачи</Button>{' '}
                        <Button size="sm" variant="warning" onClick={() => {setMembershipStatus('my tasks')}}>Мои задачи</Button>{' '}
                        <Button size="sm" variant="warning" onClick={() => {setMembershipStatus('tasks of subordinates')}}>Задачи подчинённых</Button>
                    </Card.Body>
                </Card>
            </Col>
    };

    function sortingByMembership(membershipStatus, data) {
        if (membershipStatus === 'all tasks') {
            tableBody = sortingByExpirationDate(data.tasks);
        } else if (membershipStatus === 'my tasks') {
            let myTasks = [];

            for (let myTask of data.tasks) {
                if (myTask.responsible_id === userId) {
                    myTasks.push(myTask);
                }
            }

            tableBody = sortingByExpirationDate(myTasks);
        } else if (membershipStatus === 'tasks of subordinates') {
            let tasksOfSubordinates = [];

            for (let mySubordinate of data.subordinates) {
                let tasksOfSubordinate = [];
                
                for (let task of data.tasks) {
                    if (task.responsible_id === mySubordinate.id) {
                        tasksOfSubordinate.push(task);
                    }
                }

                tasksOfSubordinates.push(<tr key={generateId()} style={{backgroundColor: 'yellow'}}><td colSpan={6}>{mySubordinate.name + ' ' + mySubordinate.patronymic + ' ' + mySubordinate.surname}</td></tr>);
                tasksOfSubordinates.push(sortingByExpirationDate(tasksOfSubordinate));
            }

            tableBody = tasksOfSubordinates;
        }
    };

    function sortingByExpirationDate(tasks) {
        let linesWithTasks;

        if (expirationDateStatus === 'tasks for all the time') {
            let arr = tasks.sort(dateComparison);

            linesWithTasks = arr.map((task) => {
                return <tr key={generateId()}>
                    <td style={settingUpTheTaskStyle(task)}>{task.title}</td>
                    <td>{task.priority}</td>
                    <td>{task.expirationDate}</td>
                    <td>{task.responsible}</td>
                    <td>{task.status}</td>
                    <td style={{textAlign: 'center'}}>{generateButtonsAction(task.iCreator, task.id)}</td>
                </tr>
            });
        } else if (expirationDateStatus === 'tasks for today') {
            let date = new Date();
            let today = new Date(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
            
            linesWithTasks = tasks.map((task) => {
                let dateDifference = dateProcessing(task.expirationDate) - today;

                if (dateDifference <= 86400000 && dateDifference >= 0) {
                    return <tr key={generateId()}>
                    <td>{task.title}</td>
                    <td>{task.priority}</td>
                    <td>{task.expirationDate}</td>
                    <td>{task.responsible}</td>
                    <td>{task.status}</td>
                    <td style={{textAlign: 'center'}}>{generateButtonsAction(task.iCreator)}</td>
                </tr>
                }

            });
        }  else if (expirationDateStatus === 'tasks for the week') {
            let date = new Date();
            let today = new Date(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
            
            linesWithTasks = tasks.map((task) => {
                let dateDifference = dateProcessing(task.expirationDate) - today;

                if (dateDifference <= 604800000 && dateDifference >= 0) {
                    return <tr key={generateId()}>
                    <td>{task.title}</td>
                    <td>{task.priority}</td>
                    <td>{task.expirationDate}</td>
                    <td>{task.responsible}</td>
                    <td>{task.status}</td>
                    <td style={{textAlign: 'center'}}>{generateButtonsAction(task.iCreator)}</td>
                </tr>
                }

            });
        }   else if (expirationDateStatus === 'tasks for the future') {
            let date = new Date();
            let today = new Date(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
            
            linesWithTasks = tasks.map((task) => {
                let dateDifference = dateProcessing(task.expirationDate) - today;

                if (dateDifference >= 0) {
                    return <tr key={generateId()}>
                    <td>{task.title}</td>
                    <td>{task.priority}</td>
                    <td>{task.expirationDate}</td>
                    <td>{task.responsible}</td>
                    <td>{task.status}</td>
                    <td style={{textAlign: 'center'}}>{generateButtonsAction(task.iCreator)}</td>
                </tr>
                }

            });
        }

        return linesWithTasks;
    };

    function openModal(event) {
        if (event.target.value === 'Добавить задачу') {
            setStatusModal('POST');
            setTaskCreator(userId);

            setTitleTask('');
            setDescriptionTask('');
            setExpirationDate(new Date);
            setPriorityTask('Низкий');
            setResponsible(userId);
            setStatusTask('Выполняется');
        } else if (event.target.value === 'Редактировать') {
            setStatusModal('PUT');

            let editableTitleTask;
            let editableDescriptionTask;
            let editableExpirationDate;
            let editablePriorityTask;
            let editableResponsible;
            let editableStatusTask;

            for (let task of data.tasks) {
                if (task.id == event.target.id) {
                    setEditableTaskId(task.id);
                    setTaskCreator(task.creator_id);

                    editableTitleTask = task.title;
                    editableDescriptionTask = task.description;
                    editableExpirationDate = task.expirationDate;
                    editablePriorityTask = task.priority;
                    editableResponsible = task.responsible_id;
                    editableStatusTask = task.status;
                    break;
                }
            }

            setTitleTask(editableTitleTask);
            setDescriptionTask(editableDescriptionTask);
            setExpirationDate(new Date(editableExpirationDate));
            setPriorityTask(editablePriorityTask);
            setResponsible(editableResponsible);
            setStatusTask(editableStatusTask);
        }

        setModalActive(true);
    };

    function openDeleteModal(event) {
        setStatusDeleteModal(true);
        setEditableTaskId(event.target.id);
    };

    function checkingForALeader(data) {
        let responsibles = [];

        if (data.subordinates.length !== 0) {
            setIsLeader(true);

            responsibles.push(<option key={generateId()} value={userId}>{userName}</option>);
            for (let subordinate of data.subordinates) {
                responsibles.push(<option key={generateId()} value={subordinate.id}>{subordinate.name}</option>);
            }
        } else {
            responsibles.push(<option key={generateId()} value={userId}>{userName}</option>);
        }

        return responsibles;
    }

    function generateButtonsAction(iCreator, taskId) {
        let deleteButton;
        if (iCreator) {
            deleteButton = <Button variant="danger" id={taskId} onClick={openDeleteModal}>Удалить</Button>;
        } else {
            deleteButton = <Button disabled variant="danger">Удалить</Button>
        }

        return <ButtonGroup size="sm">
            <Button variant="info" value="Редактировать" id={taskId} onClick={openModal}>Редактировать</Button>
            {deleteButton}
        </ButtonGroup>;
    };

    function dateComparison(task1, task2) {
        if (task1.dateOfCreation < task2.dateOfCreation) return 1;
        if (task1.dateOfCreation == task2.dateOfCreation) return 0;
        if (task1.dateOfCreation > task2.dateOfCreation) return -1;
    }

    function dateProcessing(date) {
        let arrDate = date.split(' ')[0].split('-');
        let arrTime = date.split(' ')[1].split(':');
        let dateResult = new Date(arrDate[0], arrDate[1] - 1, arrDate[2], arrTime[0], arrTime[1], arrTime[2]);
        return dateResult;
    }

    function settingUpTheTaskStyle(task) {
        if (new Date(task.expirationDate) <= new Date && task.status === "Выполняется") {
            return {color: "red"};
        } else if (task.status === "Выполнена") {
            return {color: "green"};
        }
    };

    useEffect(() => {
        loadingTasks();
    }, []);

    function loadingTasks() {
        axios({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/tasks/' + userId
        })
        .then((responce) => {
            console.log('|---------------------------------------------');
            console.log('| Получен ответ с сервера');
            console.log('| Статус:' + ' ' + responce.status);
            console.log('| Загружены данные с сервера:');
            console.log(responce.data);
            console.log('|---------------------------------------------');

            let data = responce.data;

            for (let task of data.tasks) {
                if (task.creator_id === userId) {
                    task.iCreator = true;
                } else {
                    task.iCreator = false;
                }
            }

            setResponceStatus(responce.status);
            setMembershipStatus('all tasks');
            setExpirationDateStatus('tasks for all the time');
            setAllResponsibles(checkingForALeader(data));
            setData(data);
        })
        .catch(() => {
            console.log('Ошибка загрузки данных');
            setResponceStatus('data loading error');
        });
    }

    function deleteTask() {
        axios({
            method: 'DELETE',
            url: 'http://127.0.0.1:8000/api/deleteTask/' + editableTaskId
        }).then((responce) => {
            console.log('|---------------------------------------------');
            console.log('| Получен ответ с сервера');
            console.log('| Статус:' + ' ' + responce.status);
            console.log('| Данные удалены');
            console.log('|---------------------------------------------');

            setStatusDeleteModal(false);
            loadingTasks();
        });
    };

    sortingByMembership(membershipStatus, data);

    return (
        <>
            <Card>
                <Card.Header>Система учёта задач</Card.Header>
                <Card.Body>
                    <Card.Title>Добро пожаловать, {userName} {userPatronymic}</Card.Title>
                    <div className="mb-2">
                        <Row>
                            <Col>
                                <div className="d-grid gap-4">
                                    <Button style={{width: '170px'}} variant="info" value="Добавить задачу" onClick={openModal}>Добавить задачу</Button>{' '}
                                    {[DropdownButton].map((DropdownType, idx) => (
                                        <DropdownType
                                            style={{width: '170px'}}
                                            as={ButtonGroup}
                                            key={generateId()}
                                            id={`dropdown-button-drop-${idx}`}
                                            variant="success"
                                            title="Показать задачи"
                                        >
                                            <Dropdown.Item eventKey="1" onClick={() => {setExpirationDateStatus('tasks for today')}}>на день</Dropdown.Item>
                                            <Dropdown.Item eventKey="2" onClick={() => {setExpirationDateStatus('tasks for the week')}}>на неделю</Dropdown.Item>
                                            <Dropdown.Item eventKey="3" onClick={() => {setExpirationDateStatus('tasks for the future')}}>на будущее</Dropdown.Item>
                                            <Dropdown.Divider />
                                            <Dropdown.Item eventKey="4" onClick={() => {setExpirationDateStatus('tasks for all the time')}}>за всё время</Dropdown.Item>
                                        </DropdownType>
                                    ))}
                                </div>
                            </Col>
                            {managerPanel}
                        </Row>
                    </div>
                </Card.Body>
            </Card>
            <br/>
            <Table striped bordered hover size="sm">
                <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Приоритет</th>
                        <th>Дата окончания</th>
                        <th>Ответственный</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {tableBody}
                </tbody>
            </Table>
            <ModalWindow
                userId={userId}
                userName={userName}

                active={modalActive}
                setActive={setModalActive}
                statusModal={statusModal}

                titleTask={titleTask}
                setTitleTask={setTitleTask}
                descriptionTask={descriptionTask}
                setDescriptionTask={setDescriptionTask}
                expirationDate={expirationDate}
                setExpirationDate={setExpirationDate}
                priorityTask={priorityTask}
                setPriorityTask={setPriorityTask}
                responsible={responsible}
                setResponsible={setResponsible}
                statusTask={statusTask}
                setStatusTask={setStatusTask}

                taskCreator={taskCreator}

                editableTaskId={editableTaskId}

                allResponsibles={allResponsibles}

                loadingTasks={loadingTasks}
            />
            <Modal
                show={statusDeleteModal}
                onHide={() => setStatusDeleteModal(false)}
                size="sm"
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Header>
                    <h5>Подтвердите удаление</h5>
                </Modal.Header>
                <Modal.Body>
                    <Button variant="danger" onClick={deleteTask}>Удалить</Button>{' '}
                    <Button variant="info" onClick={() => setStatusDeleteModal(false)}>Отмена</Button>
                </Modal.Body>
            </Modal>
        </>
    );
}
