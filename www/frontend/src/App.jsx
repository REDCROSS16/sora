import './index.css';
import './app.css';
import React, {useState} from 'react';
import LeftPanel from './layouts/LeftPanel/LeftPanel.jsx';
import Body from './layouts/Body/Body.jsx';
import Header from './components/Header/Header.jsx';
import JournalList from './components/JournalList/JournalList.jsx';
import JournalAddButton from './components/JournalAddButton/JournalAddButton.jsx';
import JournalForm from './components/JournalForm/JournalForm.jsx';

const INTIAL_DATA = [];

export default function App () {

	const [items, setItems] = useState(INTIAL_DATA);

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