import './index.css';
import './app.css';
import React, {useState, useEffect} from 'react';
import LeftPanel from './layouts/LeftPanel/LeftPanel.jsx';
import Body from './layouts/Body/Body.jsx';
import Header from './components/Header/Header.jsx';
import JournalList from './components/JournalList/JournalList.jsx';
import JournalAddButton from './components/JournalAddButton/JournalAddButton.jsx';
import JournalForm from './components/JournalForm/JournalForm.jsx';

const INTIAL_DATA = [
	{
		'"id"': 1,
		'title': 'test',
		'text': 'test',
		'tag': 'test',
		'date': 'new Date()'
	}
];

export default function App () {

	const [items, setItems] = useState([]);

	// читаем из локалсторадж
	useEffect(() => {
		const data = JSON.parse(localStorage.getItem('data'));

		if (data) {
			setItems(data.map((item) => ({
				...item,
				date: new Date()
			})));
		}
	}, []);

	// записываем в локалсторадж
	useEffect(() => {
		if (items.length > 0) {
			localStorage.setItem('data', JSON.stringify(items));
		}
	}, [items]);

	const addItem = (item) => {
		setItems(prevItems => [...prevItems, {
			text: item.text,
			title: item.title,
			tag: item.tag,
			date: new Date(item.date),
			id: prevItems.length > 0 ? Math.max(...prevItems.map(i => i.id)) + 1 : 1
		}]);
	};

	return (
		<div className='app'>
			<LeftPanel>
				<Header/>
				<JournalAddButton/>
				<JournalList items={items} />
			</LeftPanel>
			<Body>
				<JournalForm onSubmit={addItem}/>
			</Body>

		</div>
	);
}