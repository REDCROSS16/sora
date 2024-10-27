import ReactDOM from 'react-dom/client';
import React from 'react';
import '../scss/app.scss';
import App from './App.jsx';
import {ApolloProvider} from '@apollo/client';
import client from '../apollo/client.js';

ReactDOM.createRoot(document.getElementById('root')).render(

	<ApolloProvider client={client}>
		<App>
		</App>
	</ApolloProvider>

);