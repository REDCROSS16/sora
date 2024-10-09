import './index.css';
import './app.css';
import React, {useState, useEffect} from 'react';
import LeftPanel from './layouts/LeftPanel/LeftPanel.jsx';
import Body from './layouts/Body/Body.jsx';
import Header from './components/Header/Header.jsx';
import JournalList from './components/JournalList/JournalList.jsx';
import JournalAddButton from './components/JournalAddButton/JournalAddButton.jsx';
import JournalForm from './components/JournalForm/JournalForm.jsx';
import {useLocalStorage} from './hooks/useLocalStorage.js';

const INTIAL_DATA = [
	{
		'"id"': 1,
		'title': 'test',
		'text': 'test',
		'tag': 'test',
		'date': 'new Date()'
	}
];

function mapItems(items) {
	if (!items) {
		return [];
	}

	return items.map(i => ({
		...i,
		date: new Date(i.date)
	}));
}

export default function App () {
	const [items, setItems] = useLocalStorage('data');

	console.log(items);
	const addItem = (item) => {
		setItems([...mapItems(items), {
			text: item.text,
			title: item.title,
			tag: item.tag,
			date: new Date(item.date),
			id: items.length > 0 ? Math.max(...items.map(i => i.id)) + 1 : 1
		}]);
	};

	return (
		<div className='app'>
			<LeftPanel>
				<Header/>
				<JournalAddButton/>
				<JournalList items={mapItems(items)} />
			</LeftPanel>
			<Body>
				<JournalForm onSubmit={addItem}/>
			</Body>

		</div>
	);
}