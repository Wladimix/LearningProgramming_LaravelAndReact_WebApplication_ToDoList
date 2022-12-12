import React, { useState } from "react";
import Alert from "react-bootstrap/Alert";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import Container from "react-bootstrap/Container";
import Modal from "react-bootstrap/Modal";
import Form from "react-bootstrap/Form";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import ru from 'date-fns/locale/ru';

import axios from "axios";


export default function ModalWindow(props) {
    const [alert, setAlert] = useState(false);

    function addTask() {
        if (props.titleTask === '' || props.descriptionTask === '') {
            setAlert(true);
        } else {
            setAlert(false);
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/addTask',
                data: {
                    title: props.titleTask,
                    description: props.descriptionTask,
                    expirationDate: dateFormatting(props.expirationDate),
                    dateOfCreation: dateFormatting(new Date),
                    updateDate: dateFormatting(new Date),
                    priority: props.priorityTask,
                    status: props.statusTask,
                    creator_id: props.userId,
                    responsible_id: props.responsible
                }
            }).then((responce) => {
                console.log('|---------------------------------------------');
                console.log('| Получен ответ с сервера');
                console.log('| Статус:' + ' ' + responce.status);
                console.log('| Загружены данные на сервер:');
                console.log(responce.data);
                console.log('|---------------------------------------------');
    
                props.setActive(false);
                props.loadingTasks();
            });
        }
    }

    function updateTask() {
        if (props.titleTask === '' || props.descriptionTask === '') {
            setAlert(true);
        } else {
            setAlert(false);
            axios({
                method: 'PUT',
                url: 'http://127.0.0.1:8000/api/updateTask/' + props.editableTaskId,
                data: {
                    title: props.titleTask,
                    description: props.descriptionTask,
                    expirationDate: dateFormatting(props.expirationDate),
                    updateDate: dateFormatting(new Date),
                    priority: props.priorityTask,
                    status: props.statusTask,
                    responsible_id: props.responsible
                }
            }).then((responce) => {
                console.log('|---------------------------------------------');
                console.log('| Получен ответ с сервера');
                console.log('| Статус:' + ' ' + responce.status);
                console.log('| Данные отредактированы');
                console.log('|---------------------------------------------');
    
                props.setActive(false);
                props.loadingTasks();
            });
        }
    }

    function dateFormatting(date) {
        function addZero(num) {
            if (num >= 0 && num <= 9) {
                return '0' + num;
            } else {
                return num;
            }
        }

        let year = addZero(date.getFullYear());
        let month = addZero(date.getMonth() + 1);
        let day = addZero(date.getDate());
        let hour = addZero(date.getHours());
        let minute = addZero(date.getMinutes());
        let second = addZero(date.getSeconds());

        return year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
    }

    return <>
        <Modal
            show={props.active}
            onHide={() => {props.setActive(false)}}
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header closeButton>
                <Modal.Title id="contained-modal-title-vcenter">
                    Добавить задачу
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <div>{(alert) ? <Col><Alert variant="danger">
                    <h6>Форма не заполнена!</h6>
                    <p>Поля "Заголовок" и "Описание" не должны быть пустыми!</p></Alert></Col> : <Col></Col>}
                </div>
                <Form.Group>
                    <Form.Label>Заголовок</Form.Label>
                    <Form.Control
                        value={props.titleTask}
                        onChange={e => props.setTitleTask(e.target.value)}
                        disabled={props.userId === props.taskCreator ? false : true}
                    />
                </Form.Group><br/>
                <Form.Group>
                    <Form.Label>Описание</Form.Label>
                    <Form.Control
                        as="textarea"
                        value={props.descriptionTask}
                        onChange={e => props.setDescriptionTask(e.target.value)}
                        disabled={props.userId === props.taskCreator ? false : true}
                    />
                </Form.Group><br/>
                <Row>
                    <Col>
                        <Form.Group>
                            <Form.Label>Дата окончания</Form.Label>
                            <Container style={{marginLeft: '0px', paddingLeft: '0px'}}>
                                <DatePicker
                                    className="form-control"
                                    selected={props.expirationDate}
                                    onSelect={date => props.setExpirationDate(date)}
                                    onChange={date => props.setExpirationDate(date)}
                                    showTimeInput
                                    timeInputLabel="Время:"
                                    dateFormat="yyyy/MM/dd HH:mm"
                                    locale={ru}
                                    readOnly={props.userId === props.taskCreator ? false : true}
                                />
                            </Container>
                        </Form.Group>
                    </Col>
                    <Col>
                        <Form.Group>
                            <Form.Label>Приоритет</Form.Label>
                            <Form.Control
                                value= {props.priorityTask}
                                onChange={(e) => {props.setPriorityTask(e.target.value)}}
                                as="select"
                                disabled={props.userId === props.taskCreator ? false : true}
                            >
                                <option value='Низкий'>Низкий</option>
                                <option value='Средний'>Средний</option>
                                <option value='Высокий'>Высокий</option>
                            </Form.Control>
                        </Form.Group>
                    </Col>
                    <Col>
                        <Form.Group>
                            <Form.Label>Ответственный</Form.Label>
                            <Form.Control
                                value= {props.responsible}
                                onChange={(e) => {props.setResponsible(e.target.value)}}
                                as="select"
                                disabled={props.userId === props.taskCreator ? false : true}
                            >
                                {props.allResponsibles}
                            </Form.Control>
                        </Form.Group>
                    </Col>
                    <Col>
                        <Form.Group>
                            <Form.Label>Статус</Form.Label>
                            <Form.Control
                                value= {props.statusTask}
                                onChange={(e) => {props.setStatusTask(e.target.value)}}
                                as="select"
                            >
                                <option value='Выполняется'>Выполняется</option>
                                <option value='Выполнена'>Выполнена</option>
                            </Form.Control>
                        </Form.Group>
                    </Col>
                </Row>
            </Modal.Body>
            <Modal.Footer>
                <Row>
                    {props.statusModal === 'POST' ? 
                        <Col><Button variant="info" onClick={() => addTask()}>Добавить</Button></Col> :
                        <Col><Button variant="info" onClick={() => updateTask()}>Редактировать</Button></Col>
                    }
                    <Col><Button onClick={() => {props.setActive(false)}}>Закрыть</Button></Col>
                </Row>
            </Modal.Footer>
        </Modal>
    </>
}
