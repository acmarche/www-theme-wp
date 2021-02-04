import HardCodedValues from './HardCodedValues';
import KeywordsValue from './KeywordsValue';
import axios from '../Axios';

const {
    useState,
    useEffect
} = wp.element;

function App() {
    const [ inputContent, setInputContent ] = useState();
    const [ keywordsElement, SetKeywordsElement ] = useState([]);

    // Cette fonction change la valeur de la variable inputContent
    // a chaque fois que l'utilisateur entre une lettre ou en supprime
    const handleChange = ( e ) => {
        setInputContent( e.target.value );
    };

    // C'est ici que je charge ma liste de proposition grace a axios
    useEffect( () => {
        axios
            .get( 'https://new.marche.be/wp-json/ca/v1/bottinAllCategories' )
            .then( ( res ) => {
                SetKeywordsElement( res.data );
            })
            .catch( ( err ) => console.log( err.message ) );
    }, []);

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
                {inputContent ? (
                    <KeywordsValue
                        inputContent={inputContent}
                        keywordsElement={keywordsElement}
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
