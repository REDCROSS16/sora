import Button from './components/Button/Button.jsx';
import JournalItem from './components/JournalItem/JournalItem.jsx';
import './index.css';
import {Component} from 'react';
import React from 'react';

export default class App extends Component {
    render() {
        return (
            <>
                <h1> Заголовок3 </h1>
                <Button />
                <JournalItem />
            </>
        );
    }
}