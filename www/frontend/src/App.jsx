import JournalItem from './components/JournalItem/JournalItem.jsx';
import './index.css';
import {Component} from 'react';
import React from 'react';
import CardButton from './components/CardButton/CardButton.jsx';

const data = [ {
	title: 'Подготовка к обновлению курсов23',
	date: new Date(),
	text: 'Какойто текст для пропсов'
}, {
	title: 'Подготовка к обновлению курсов123',
	date: new Date(),
	text: 'Какойто текст для пропсов2'
}
];

export default class App extends Component {
	render() {
		return (
			<>
				<CardButton>
					<JournalItem
						title={data[0].title}
						date={data[0].date}
						text={data[0].text}
					/>
				</CardButton>

				<CardButton>
					<JournalItem
						title={data[1].title}
						date={data[1].date}
						text={data[1].text}
					/>
				</CardButton>

				<div className='App'>
					<AddTodo/>
					<TodoList/>
				</div>
			</>
		);
	}
}