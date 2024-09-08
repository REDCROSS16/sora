import Button from './components/Button/Button.jsx';
import JournalItem from './components/JournalItem/JournalItem.jsx';
import './index.css';
import {Component} from 'react';
import React from 'react';
import CardButton from './components/CardButton/CardButton.jsx';

const data = [ {
	title: 'Подготовка к обновлению курсов',
	date: new Date(),
	text: 'Какойто текст для пропсов'
}, {
	title: 'Подготовка к обновлению курсов1',
	date: new Date(),
	text: 'Какойто текст для пропсов2'
}
];


export default class App extends Component {
	render() {
		return (
			<>
				<h1> Заголовок3 </h1>
				<Button />

				<CardButton>
					<JournalItem
						title={data[0].title}
						date={data[0].date}
						text={data[0].text}
					/>
				</CardButton>


				<JournalItem
					title={data[1].title}
					date={data[1].date}
					text={data[1].text}
				/>
			</>
		);
	}
}