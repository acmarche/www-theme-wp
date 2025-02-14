import HardCodedValues from './HardCodedValues';
import Icones from './Icones';
import Suggestions from './Suggestions';
import {suggestElastic} from '../Search/service/search-service';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [keyword, setKeyword] = useState('');
    const [searchTimeout, setSearchTimeout] = useState(null);
    const [suggestionsList, setSuggestionsList] = useState([]);

    const handleChange = (event) => {
        const query = event.target.value;

        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        setSearchTimeout(setTimeout(() => {
            setKeyword(query);
            setSearchTimeout(null);
        }, 500));
    };

    async function executeSearch() {
        let response;
        try {
            response = await suggestElastic(keyword);
            const {data} = response;
            setSuggestionsList(data);
        } catch (e) {
            console.log(e);
        }
        return null;
    }

    const isSearching = undefined !== keyword && 2 < keyword.length;

    useEffect(() => {
        if (isSearching) {
            executeSearch(keyword);
        }
    }, [keyword]);

    return (
        <>
            <h1 className="pb-22px">Bienvenue <br className="d-ls-md-none d-md-none"/>à
                Marche-en-Famenne</h1>
            <form action="/" method="get" className="mw-550px position-relative m-auto searchHome">
                <input
                    name="s"
                    autoComplete="off"
                    type="search"
                    placeholder="Que cherchez-vous ?"
                    className="border-0 rounded-pill h-42px pl-16px pr-58px fs-short-3"
                    onChange={(e) => handleChange(e)}
                />
                <button
                    type="submit"
                    className="position-absolute top-0 bottom-0 right-0 w-42px d-flex justify-content-center align-items-center p-0 border-0 rounded-right-pill bg-transparent icon_custom">
                    <i className="i-search i-dark-primary"></i>
                </button>
                <div className="bubble d-ls-lg-none d-lg-none">
                    <i className="graphicElement"></i>
                    {isSearching ? (
                            <>
                                <i className="graphicElement"></i>
                            </>
                        )
                        : (
                            <HardCodedValues/>
                        )}
                    <i className="graphicElement"></i>
                </div>
            </form>
            <Icones></Icones>
        </>
    );
}

export default App;
