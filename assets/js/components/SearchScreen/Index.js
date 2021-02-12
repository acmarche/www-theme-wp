import HardCodedValues from './HardCodedValues';
import Suggestions from './Suggestions';
import { suggestElastic } from '../Search/service/search-service';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [ keyword, setKeyword ] = useState( '' );
    const [ searchTimeout, setSearchTimeout ] = useState( null );
    const [ suggestionsList, setSuggestionsList ] = useState([]);

    const handleChange = ( event ) => {
        const query = event.target.value;

        if ( searchTimeout ) {
            clearTimeout( searchTimeout );
        }

        setSearchTimeout( setTimeout( () => {
            setKeyword( query );
            setSearchTimeout( null );
        }, 500 ) );
    };

    async function executeSearch() {
        let response;
        try {
            response = await suggestElastic( keyword );
            const { data } = response;
            setSuggestionsList( data );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    const isSearching = undefined !== keyword && 2 < keyword.length;

    useEffect( () => {
        if ( isSearching ) {
            executeSearch( keyword );
        }
    }, [ keyword ]);

    return (
        <>
            <i className="graphicElement"></i>
            <ul>
                <li className="col-ls-12">
                    <form className="h-32px">
                        <input
                            type="search"
                            placeholder="Que cherchez-vous ?"
                            className="border-0 rounded-pill h-32px pl-16px pr-48px fs-short-3"
                            onChange={( e ) => handleChange( e )}
                        />
                        <button
                            className="position-absolute top-0 bottom-0 right-0 w-32px h-32px d-flex justify-content-center align-items-center p-0 border-0 rounded-right-pill bg-transparent icon_custom">
                            <i className="i-search i-dark-primary w-16px h-16px"></i>
                        </button>
                    </form>
                    <a href="#" className="icon_custom">
                        <i className="i-times" id="btn-close-search"></i>
                    </a>
                </li>
                {isSearching ? (
                    <Suggestions
                        suggestionsList={suggestionsList}
                    />
                ) : (
                    <HardCodedValues/>
                )}
            </ul>
            <i className="graphicElement"></i>
        </>
    );
}

export default App;
