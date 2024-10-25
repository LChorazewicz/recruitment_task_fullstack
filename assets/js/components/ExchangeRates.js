import React, {Component} from 'react';
import axios from 'axios';
import {HttpState} from "../utils/Http";

class ExchangeRates extends Component {
    constructor() {
        super();
        this.state = {
            todayExchangeRates: [],
            historicalExchangeRates: [],
            state: HttpState.LOADING,
            date: null
        };
    }

    fetch(date) {
        axios.get(`${this.getBaseUrl()}/api/exchange-rates?date=${date}`).then(response => {
            this.setState({
                todayExchangeRates: response.data.today,
                historicalExchangeRates: response.data.date,
                state: HttpState.LOADED,
                date: date
            });
        }).catch(function (error) {
            this.setState(prev => ({
                todayExchangeRates: [],
                historicalExchangeRates: [],
                state: HttpState.ERROR,
                date: date
            }))
        }.bind(this));
    }

    getBaseUrl() {
        return 'http://telemedi-zadanie.localhost';
    }

    componentDidMount() {
        this.fetch(this.getDefaultDate());
    }

    onChange(event) {
        this.fetch(event.target.value);
        window.history.replaceState(null, '', `/exchange-rates/${event.target.value}`)
    }

    getDefaultDate() {
        return this.state.date ?? this.props.match.params?.date ?? new Date().toISOString().split('T')[0]
    }

    prepareData(historicalData, todayData) {
        const historicalDataExist = historicalData.length;
        const todayDataExist = todayData.length;

        const codesFromToday = todayData.map((item) => item.code);
        const codesFromHistorical = historicalData.map((item) => item.code);

        return [...codesFromToday, ...codesFromHistorical].map((item, index) => ({
            code: item,
            name: todayDataExist ? todayData[index].name : (historicalDataExist ? historicalData[index].name : '-'),
            base: todayDataExist ? todayData[index].base : null,
            buy: todayDataExist ? todayData[index].buy : null,
            sell: todayDataExist ? todayData[index].sell : null,
            historicSell: historicalDataExist ? historicalData[index].sell : null,
            historicBuy: historicalDataExist ? historicalData[index].buy : null,
            historicBase: historicalDataExist ? historicalData[index].base : null,
        }));
    }

    render() {
        const onChange = (e) => this.onChange(e)
        const defaultValue = () => this.getDefaultDate();
        const state = this.state.state
        const todayData = this.state.todayExchangeRates;
        const historicalData = this.state.historicalExchangeRates;
        const historicalSuffix = ` w dniu ${this.state.date ?? '-'}`
        const cols = [
            'Kod',
            'Nazwa',
            `Kupno ${historicalSuffix}`,
            `Sprzedaż ${historicalSuffix}`,
            `Średni kurs NBP ${historicalSuffix}`,
            'Kupno dziś',
            'Sprzedaż dziś',
            'Średni kurs NBP dziś'
        ]

        const table = (todayData, historicalData) => {
            const data = this.prepareData(historicalData, todayData);

            return <table className={"table"}>
                <tbody>
                <tr>
                    {cols.map((column, key) => {
                        return <th key={key}>{column}</th>
                    })}
                </tr>
                {data.map((row, key) => {
                    return <tr key={key}>
                        <td>{row.code}</td>
                        <td>{row.name}</td>
                        <td bgcolor={'silver'}>{row.historicBuy ? Number(row.historicBuy).toFixed(4) : '-'}</td>
                        <td bgcolor={'silver'}>{row.historicSell ? Number(row.historicSell).toFixed(4) : '-'}</td>
                        <td bgcolor={'silver'}>{row.historicBase ? Number(row.historicBase).toFixed(4) : '-'}</td>
                        <td>{row.base ? Number(row.base).toFixed(4) : '-'}</td>
                        <td>{row.buy ? Number(row.buy).toFixed(4) : '-'}</td>
                        <td>{row.sell ? Number(row.sell).toFixed(4) : '-'}</td>
                    </tr>
                })}
                {data.length <= 0 ? <tr>
                    <td colSpan={8} className={'text-center'}>Brak danych do wyświetlenia.</td>
                </tr> : null}
                </tbody>
            </table>
        };

        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row mt-5">
                            <div className="col-md-8 offset-md-2">
                                {state !== HttpState.LOADED && <h5 className={'text-danger py-2'}>
                                    {state === HttpState.LOADING ? 'Ładowanie...' : null}
                                    {state === HttpState.ERROR ? 'Wystąpił błąd podczas ładowania danych. Sprawdź poprawność linku.' : null}
                                </h5>}

                                <div className="form-group pb-5">
                                    <label htmlFor="date">Data:</label>
                                    <input
                                        type="date" className="form-control" id="date" min={"2023-01-01"}
                                        onChange={onChange} value={defaultValue()}
                                    />
                                </div>

                                <div className={'pb-5'}>
                                    <h2 className="text-center">Kurs</h2>
                                    {table(todayData, historicalData)}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        )
    }
}

export default ExchangeRates;
