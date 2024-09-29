import './JournalList.css';
import CardButton from '../CardButton/CardButton.jsx';
import JournalItem from '../JournalItem/JournalItem.jsx';
import React from 'react';

function JournalList({items}) {

	const sortItems = (a, b) => {
		return (a.date > b.date) ? 1 : -1;
	};

	return (
		<div className='journal-list'>
			{ items.length === 0 && <p>Записей нет</p>}
			{ items.length > 0 && items.sort(sortItems).map(el => (
				<CardButton key={el.id}>
					<JournalItem
						title={el.title}
						date={el.date}
						text={el.text}
					/>
				</CardButton>
			))}
		</div>
	);
}

export default JournalList;