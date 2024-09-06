import Button from './components/Button/Button.jsx';
import {Component} from 'react';
import React from 'react';

export default class App extends Component {
    render() {
        return (
            <>
                <h1> Заголовок1 </h1>
                <p> Какой-то текст</p>
                <Button />
            </>
        );
    }
}